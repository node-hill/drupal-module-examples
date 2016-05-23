<?php

namespace Drupal\example_config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Color entity.
 *
 * @ConfigEntityType(
 *   id = "color",
 *   label = @Translation("Color"),
 *   handlers = {
 *     "list_builder" = "Drupal\example_config_entity\ColorListBuilder",
 *     "form" = {
 *       "add" = "Drupal\example_config_entity\Form\ColorForm",
 *       "edit" = "Drupal\example_config_entity\Form\ColorForm",
 *       "delete" = "Drupal\example_config_entity\Form\ColorDeleteForm",
 *     }
 *   },
 *   config_prefix = "color",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "color_code",
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/example_config_entity/{color}",
 *     "delete-form" = "/admin/config/system/example_config_entity/{color}/delete",
 *   }
 * )
 */
class Color extends ConfigEntityBase {

  /**
   * The color unique id.
   *
   * @var string
   */
  protected $id;

  /**
   * The human readable name of the color.
   *
   * @var string
   */
  protected $label;

  /**
   * The hex color code.
   *
   * @var string
   */
  protected $color_code;

  /**
   * Get the color code of the color.
   *
   * @return string
   */
  public function getColorCode() {
    return $this->color_code;
  }
}
