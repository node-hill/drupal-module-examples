<?php 

namespace Drupal\hello_world_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloWorldForm extends FormBase {

  /**
   * Define a unique form id.
   */
  public function getFormId() {
    return 'hello_world_form';
  }

  /**
   * Add elements to form array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Textfield.
    $form['subject'] = array(
      '#type' => 'textfield',
      '#title' => 'Subject',
    );

    // E-mail field.
    $form['email'] = array(
      '#type' => 'email',
      '#title' => 'E-mail address',
    );

    // Radio buttons.
    $form['radio'] = array(
      '#type' => 'radios',
      '#title' => 'E-mail background color',
      '#options' => array('Red', 'Green', 'Blue'),
    );


    // Body field. 
    $form['body'] = array(
      '#type' => 'textarea',
      '#title' => 'Body text',
    );

    // Submit button.
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Skicka',
    );


    return $form;
  }

    /**
     * Do we need to validate the form data?
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      // Check if given email is valid.
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $form_state->setErrorByName('email', $this->t('Not a valid e-mail address.'));
      }
    }

    /**
     * What should happen when form is submitted?
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      // Notyify user that we've sent an email greeting.
      drupal_set_message($this->t('A e-mail greeting has been sent to @email', array('@email' => $form_state->getValue('email'))));

    }

}