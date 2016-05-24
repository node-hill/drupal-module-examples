<?php

namespace Drupal\movies\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MovieSettingsForm extends FormBase {

  /**
   * The unique ID of the movie settings form.
   */
  public function getFormId() {
    return 'movie_settings_form';
  }

  /**
   * Build the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['movie_settings']['#markup'] = $this->t('Settings for the movie entity');

    return $form;
  }

  /**
   * Handle the form submit.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Leave empty since we have nothing to save on submit.
  }
}
