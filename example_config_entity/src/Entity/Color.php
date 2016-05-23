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
   * @var
   */
  protected $id;

  /**
   * The human readable name of the color.
   *
   * @var
   */
  protected $label;
}
