<?php

namespace Drupal\example_config_entity\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\example_config_entity\Entity\Color;

/**
 * Provides a 'Colors' Block
 *
 * @Block(
 *   id = "example_config_entity_colors_block",
 *   admin_label = @Translation("Colors"),
 * )
 */
class ColorBlock extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [
      '#cache' => [
        'tags' => ['config:color_list'],
      ],
    ];

    // Creates a cache object from the "build" render array.
    $cacheability = CacheableMetadata::createFromRenderArray($build);

    $build['colors'] = [
      '#theme' => 'item_list',
      '#items' => [],
    ];

    // Add each color to the item list.
    foreach ($this->getColors() as $color) {
      $build['colors']['#items'][] = [
        '#markup' => $color->label(),
        '#wrapper_attributes' => [
          'style' => "color: {$color->getColorCode()};",
        ],
      ];

      // Sets the color as a cache dependency. Each time one of these colors
      // that are added are changed the cache is invalidated.
      $cacheability->addCacheableDependency($color);
    }

    // Apply the data from the cache object back to the "build" render array.
    $cacheability->applyTo($build);

    return $build;
  }

  /**
   * @return Color[]
   */
  private function getColors() {
    return \Drupal::entityTypeManager()
      ->getStorage('color')
      ->loadMultiple();
  }
}
