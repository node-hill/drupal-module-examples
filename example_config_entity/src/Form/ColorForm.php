<?php

namespace Drupal\example_config_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ColorForm extends EntityForm {

  /**
   * The Drupal entity query service.
   *
   * @var QueryFactory
   */
  protected $entityQuery;

  /**
   * @param QueryFactory $entity_query
   *   The entity query.
   */
  public function __construct(QueryFactory $entity_query) {
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    // The label of the color.
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('This is the name of the color you want to add.'),
      '#required' => TRUE,
    ];

    // The color unique id or machine-name as it may also be called.
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#disabled' => !$this->entity->isNew(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
    ];

    // The hex color code for this color.
    $form['color_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Color code'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->getColorCode(),
      '#description' => $this->t('Specify the color code for this color.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $status = $this->entity->save();

    // Set different messages depending on the save status of the color.
    if ($status) {
      drupal_set_message($this->t('Saved the %label Color.', [
        '%label' => $this->entity->label(),
      ]));
    }
    else {
      drupal_set_message($this->t('The %label Color was not saved.', [
        '%label' => $this->entity->label(),
      ]));
    }

    // Redirect to the list of colors.
    $form_state->setRedirect('entity.color.collection');
  }

  /**
   * Callback to check if the id of the color is unique.
   *
   * @param string $id
   *   The id to check against.
   *
   * @return bool
   */
  public function exist($id) {
    $entity = $this->entityQuery->get('color')
      ->condition('id', $id)
      ->execute();

    return (bool) $entity;
  }
}
