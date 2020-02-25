<?php

namespace Drupal\beam_pdf;


class PDFGenerator {

  private $pdfs;
  private $configs;
  private $path;
  private $resultPath;

  public function __construct() {
    // @TODO. Now using PYTHON
    $this->pdfs = [
      'NOFOTO' => [
        'bottle_15l' => '1.5L_PERSONALISED_LABEL/JB225_1.5L_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_1l' => '1L_PERSONALISED_LABEL/JB225_1L_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_70cl' => '70CL_PERSONALISED_LABEL/JB225_70CL_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
        'bottle_75cl' => '75CL_PERSONALISED_LABEL/JB225_75CL_PERSONALISED_LABEL_NO_FACE_AW03_HR.pdf',
      ],
      'FOTO' => [
        'bottle_15l' => '1.5L_PERSONALISED_LABEL/JB225_1.5L_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_1l' => '1L_PERSONALISED_LABEL/JB225_1L_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_70cl' => '70CL_PERSONALISED_LABEL/JB225_70CL_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
        'bottle_75cl' => '75CL_PERSONALISED_LABEL/JB225_75CL_PERSONALISED_LABEL_WITH_FACE_AW03_HR.pdf',
      ],
    ];

    $this->configs = [
      'bottle_15l' => [
        'name' => [303, 308],
        'label' => [305, 337],
        'image' => [515, 285],
        'image_ratio' => 1.5,
      ],
      'bottle_1l' => [
        'name' => [262, 307],
        'label' => [264, 337],
        'image' => [440, 285],
        'image_ratio' => 1.5,
      ],
      'bottle_70cl' => [
        'name' => [240, 295],
        'label' => [242, 325],
        'image' => [404, 270],
        'image_ratio' => 1.6,
      ],
      'bottle_75cl' => [
        'name' => [240, 295],
        'label' => [242, 325],
        'image' => [404, 270],
        'image_ratio' => 1.6,
      ]
    ];

    $this->resultPath = __DIR__ . '/../includes/result/';
    $this->path = drupal_get_path('module', 'beam_pdf') . '/includes/templates/';
  }

  public function createPdfs($values) {
    $result = [];
    foreach ($values as $value) {
      $pdf = $value['picture'] ? $this->pdfs['FOTO'][$value['bottle']] : $this->pdfs['NOFOTO'][$value['bottle']];
      $pdfTron = new PDFTron($value['id'], $pdf, $this->resultPath . 'pdf-' . $value['id'] . '.pdf', $value['subhead'], $value['label'], $value['bottle'], $value['alphabet'], $value['picture']);
      $result[$value['id']] = $pdfTron->render();
    }

    return $result;
  }
}
