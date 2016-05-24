<?php

namespace Drupal\movies\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;

class MovieDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * Returns the question to ask the user.
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to remove the %label movie?', [
      '%label' => $this->entity->label(),
    ]);
  }

  /**
   * Returns the route to go to if the user cancels the action.
   */
  public function getCancelUrl() {
    return \Drupal\Core\Url::fromRoute('entity.movie.collection');
  }
}
