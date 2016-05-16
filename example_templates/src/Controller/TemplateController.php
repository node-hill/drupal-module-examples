<?php

namespace Drupal\example_templates\Controller;

use Drupal\Core\Controller\ControllerBase;

class TemplateController extends ControllerBase {

  /**
   * Renders our example templates.
   *
   * @return array
   */
  public function templates() {
    $elements = [];

    $elements['link'] = [
      '#theme' => 'example_link',
      '#text' => $this->t('Codecademy'),
      '#url' => 'https://www.codecademy.com/',
    ];

    $elements['colors'] = [
      '#theme' => 'example_colors',
      '#colors' => ['Black', 'Blue', 'Green', 'Red', 'White', 'Yellow'],
    ];

    $elements['date'] = [
      '#theme' => 'example_date',
      '#date' => '2004-11-23',
    ];

    return $elements;
  }
}
