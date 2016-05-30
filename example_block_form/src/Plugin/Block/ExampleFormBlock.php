<?php

namespace Drupal\example_block_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\example_block_form\Form\BlockForm;

/**
 * Provides a 'Form' Block
 *
 * @Block(
 *   id = "example_form_block",
 *   admin_label = @Translation("Form block"),
 * )
 */
class ExampleFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm(BlockForm::class);
  }
}
