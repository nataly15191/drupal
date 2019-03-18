<?php
/**
 * @file
 * Contains \Drupal\custom_form_in_block\Form.
 */
namespace Drupal\form_in_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FormInBlockForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_in_block_form';
  }
  /**
   * {@inheritdoc}
   * Form
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#placeholder' => 'Your Name *',
      //'#required' => TRUE
    );
    $form['email'] = array(
      '#type' => 'email',
      '#placeholder' => 'E-mail *',
      //'#required' => TRUE
    );
    $form['ware_housing'] = array(
      '#type' => 'textfield',
      '#placeholder' => 'Ware Housing',
    );
    $form['subject'] = array(
      '#type' => 'textfield',
      '#placeholder' => 'Subject',
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#placeholder' => 'Message...',
    );
    $form['button'] = array(
      '#type' => 'submit',
      '#value' => 'SEND MESSAGE'
    );

    return $form;
  }
  /**
   * {@inheritdoc}
   * Submit
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $your_name = $form_state->getValue('your_name');
    drupal_set_message($your_name);


  }
}