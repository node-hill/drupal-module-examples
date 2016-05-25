<?php

namespace Drupal\movies\Entity;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class MovieForm extends ContentEntityForm {

  /**
   * We implement the save method so that we can redirect to the created
   * movie entity.
   */
  public function save(array $form, FormStateInterface $form_state) {
    // Make sure the parent save method in invoked.
    parent::save($form, $form_state);

    // Redirect to the movie.
    $form_state->setRedirectUrl($this->entity->toUrl());
  }
}
