<?php

namespace Drupal\hello_world_template\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * The hello world template controller.
 */
class HelloWorldTemplateController extends ControllerBase {

  /**
   * Renders our hello world page.
   *
   * @return array
   */
  public function content() {
    return [
      '#theme' => 'hello_world',
      '#message' => $this->t('Hello world with a template!'),
    ];
  }
}
