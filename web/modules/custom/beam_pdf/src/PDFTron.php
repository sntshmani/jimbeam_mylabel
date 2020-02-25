<?php

namespace Drupal\beam_pdf;

use Drupal\beam_misc\Helper\MiscHelper;

class PDFTron {

  private $id;
  private $filename;
  private $output;
  private $subhead;
  private $label;
  private $bottle;
  private $alphabet;
  private $image;
  private $filePath;

  public function __construct($id, $filename, $output, $subhead, $label, $bottle, $alphabet, $image = false) {
    $this->id = $id;
    $this->filename = $filename;
    $this->output = $output;
    $this->subhead = $subhead;
    $this->label = $label;
    $this->bottle = $bottle;
    $this->alphabet = $alphabet;
    $this->image = $image;

    $this->filePath = MiscHelper::pathPublic();
  }


  public function render() {
    $image = $this->image ? __DIR__ . '/../../../..' . file_url_transform_relative($this->image) : false;
    $params = [
      $this->id,
      $this->label,
      $this->subhead,
      $this->bottle,
      $image,
      $this->alphabet,
    ];
    $json = json_encode($params);
    $base64 = base64_encode($json);

    $filePython = __DIR__ . '/python/main.py';
    // Create file in tmp folder and then, copy this file in drupal file directory
    $cmdCreate = 'python3 ' . $filePython . ' ' . $base64 . ' 2>&1';  //LC_ALL=en_US.UTF-8
    $cmdCopy = 'mv /tmp/drawing-' . $this->id . '.pdf ' . $this->filePath . ' 2>&1';
    $cmd1 = shell_exec($cmdCreate);
    $cmd2 = shell_exec($cmdCopy);
    $messageCmd = $cmd2 ? $cmd2 : t('Created file');

    \Drupal::logger('beam_pdf')->notice($cmd1);
    \Drupal::logger('beam_pdf')->error($messageCmd);

    // No message in cmd2 when successfully creation, else error
    return [
      'status' => !$cmd2 ? 2 : 5,
      'url' => !$cmd2 ? 'public://drawing-' . $this->id . '.pdf' : NULL
    ];
  }
}
