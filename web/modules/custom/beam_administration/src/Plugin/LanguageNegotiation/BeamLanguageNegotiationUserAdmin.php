<?php

namespace Drupal\beam_administration\Plugin\LanguageNegotiation;

use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\user\Plugin\LanguageNegotiation\LanguageNegotiationUserAdmin;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Shows administration pages always in english.
 *
 * @LanguageNegotiation(
 *   id = Drupal\beam_administration\Plugin\LanguageNegotiation\BeamLanguageNegotiationUserAdmin::METHOD_ID,
 *   types = {Drupal\Core\Language\LanguageInterface::TYPE_INTERFACE},
 *   weight = -9,
 *   name = @Translation("Account administration pages in English"),
 *   description = @Translation("Account administration pages in English language setting.")
 * )
 */
class BeamLanguageNegotiationUserAdmin extends LanguageNegotiationUserAdmin{

  /**
   * The language negotiation method id.
   */
  const METHOD_ID = 'beam-language-user-admin';

  /**
   * {@inheritdoc}
   */
  public function getLangcode(Request $request = NULL) {
    try {
      return $this->isAdminPath($request) || $this->shouldBeInEnglish($request) ? 'en' : NULL;
    }
    catch (MethodNotAllowedException $e) {
      return 'NULL';
    }
  }


  /**
   * Checks whether the given path is an administrative one.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   *
   * @return bool
   *   TRUE if the path is administrative, FALSE otherwise.
   */
  protected function shouldBeInEnglish(Request $request) {
    $result = FALSE;
    if ($request && $this->adminContext) {
      // If called from an event subscriber, the request may not have the route
      // object yet (it is still being built), so use the router to look up
      // based on the path.
      $route_match = $this->stackedRouteMatch->getRouteMatchFromRequest($request);
      if ($route_match && !$route_object = $route_match->getRouteObject()) {
        try {
          // Some inbound path processors make changes to the request. Make a
          // copy as we're not actually routing the request so we do not want to
          // make changes.
          $cloned_request = clone $request;
          // Process the path as an inbound path. This will remove any language
          // prefixes and other path components that inbound processing would
          // clear out, so we can attempt to load the route clearly.
          $path = $this->pathProcessorManager->processInbound(urldecode(rtrim($cloned_request->getPathInfo(), '/')), $cloned_request);
          $attributes = $this->router->match($path);
        }
        catch (ResourceNotFoundException $e) {
          return FALSE;
        }
        catch (AccessDeniedHttpException $e) {
          return FALSE;
        }
        $route_object = $attributes[RouteObjectInterface::ROUTE_OBJECT];
      }
      $english_paths = [
        '/user/login'
      ];
      $result = in_array($route_object->getPath(), $english_paths);
    }
    return $result;
  }

}
