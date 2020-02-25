<?php

namespace Drupal\beam_misc\Helper;

use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\File\FileSystemInterface;
use Imagick;
use ImagickPixel;

class ImageHelper {

  public static function getValidExtensions() {
    return ['jpg', 'png', 'jpeg'];
  }

  public static function imageToDrawing($uri) {
    try {
      $imagick = new Imagick($uri);
      // Scale and crop to picture_bottle style (Scale and crop 160x196)
      $imagick->cropThumbnailImage(160, 196);

      // Steps:
      // 1.- Grayscale the image
      // 2.- Invert it
      // 3.- Blur the inverted image
      // 4.- Dodge blend the blurred and grayscale image.
      $imagick->setImageType(Imagick::IMGTYPE_GRAYSCALE);
      header("Content-Type: image/jpg");
      $resultGrey = $imagick->getImageBlob();
      $fileResultDrawing = self::saveImage($resultGrey, 'public://drawing-grey-test.png');
      $imagickGrey = new Imagick($fileResultDrawing['uri']);

      $imagick->negateImage(true);
      $imagick->blurImage(100, 10);
      $imagick->setImageMatte(1);

      // With generated image, round corners
      $imagickGrey->compositeImage($imagick, Imagick::COMPOSITE_COLORDODGE, 0, 0);
      $imagickGrey->roundCorners(90, 90);
      $imagickGrey->setBackgroundColor(new ImagickPixel('transparent'));
      $imagickGrey->setImageFormat('png');

      header("Content-Type: image/png");
      return $imagickGrey->getImageBlob();
    } catch (\ImagickException $e) {
    }
  }

  public static function saveImage($fileContents, $filename) {
    $file = file_save_data($fileContents, $filename, FileSystemInterface::EXISTS_RENAME);
    try {
      $file->save();
      if ($file) {
        $uri = $file->getFileUri();
        return [
          'id' => $file->id(),
          'uri' => $uri,
          'url' => file_create_url($uri)
        ];
      }
    }
    catch (EntityStorageException $e) {
    }
  }
}
