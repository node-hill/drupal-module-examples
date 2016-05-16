<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * The hello world controller.
 */
class HelloWorldController extends ControllerBase {

  /**
   * Renders our hello world page.
   *
   * @return array
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello world'),
    ];
  }
}
