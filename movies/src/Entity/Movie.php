<?php

namespace Drupal\movies\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItem;

/**
 * Defines the movie content entity.
 *
 * @ContentEntityType(
 *   id = "movie",
 *   label = @Translation("Movie"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\movies\MovieListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\movies\Form\MovieDeleteForm",
 *     },
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *   },
 *   base_table = "movies",
 *   admin_permission = "administer site configuration",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/movie/{movie}",
 *     "edit-form" = "/movie/{movie}/edit",
 *     "delete-form" = "/movie/{movie}/delete",
 *     "collection" = "/admin/content/movies",
 *   },
 *   field_ui_base_route = "movies.settings"
 * )
 */
class Movie extends ContentEntityBase implements EntityChangedInterface {

  use EntityChangedTrait;

  public function getReleaseDate() {
    return $this->get('release_date')->value;
  }

  public function getRating() {
    return $this->get('rating')->value;
  }

  /**
   * Defines the fields for the movies content entity.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // We call the parent baseFieldDefinitions method before defining our own
    // fields since it will add the id and uuid fields automatically.
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the movie title field.
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Title'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayOptions('view', [
        'type' => 'string',
        'weight' => 0,
      ]);

    // Add the movies release date.
    $fields['release_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(new TranslatableMarkup('Release date'))
      ->setDescription(new TranslatableMarkup('When the movie was released.'))
      ->setRequired(TRUE)
      ->setSettings([
        'datetime_type' => DateTimeItem::DATETIME_TYPE_DATE,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_default',
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'type' => 'datetime_default',
        'weight' => 1,
      ]);

    // Add the rating field with an allowed range of 1-10.
    $fields['rating'] = BaseFieldDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Rating'))
      ->setDescription(new TranslatableMarkup('The rating of the movie on a 1-10 scale.'))
      ->setSettings([
        'min' => 0,
        'max' => 10,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 2,
      ])
      ->setDisplayOptions('view', [
        'type' => 'number_integer',
        'weight' => 2,
      ]);

    // When the entity was created.
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(new TranslatableMarkup('Created'))
      ->setDescription(new TranslatableMarkup('The time that the entity was created.'));

    // When the entity was last changed.
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(new TranslatableMarkup('Changed'))
      ->setDescription(new TranslatableMarkup('The time that the entity was last edited.'));

    return $fields;
  }

}
