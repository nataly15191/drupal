<?php

namespace Drupal\my_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Mail\Plugin\Mail\PhpMail;

use Drupal\Component\Utility\SafeMarkup;

class MyForm extends FormBase {
  
  public $properties = [];
  
  public function getFormId() {
    return 'my_form';
  }
  
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => 'First name',
      '#required' => TRUE
    );
    $form['last_name'] = array(
      '#type' => 'textfield',
      '#title' => 'Last name',
      '#required' => TRUE
    );
    $form['subject'] = array(
      '#type' => 'textfield',
      '#title' => 'Subject',
      '#required' => TRUE
    );
    $form['message'] = array(
      '#type' => 'textarea',
      '#title' => 'Message',
      '#required' => TRUE
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your e-mail address'),
      '#required' => TRUE
    );
    $form['button'] = array(
      '#type' => 'submit',
      '#value' => 'Submit'
    );
  return $form;
  }
   
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
      
    if (strpos($form_state->getValue('email'), '.com') === FALSE) {
        
       $form_state->setErrorByName('email', 'E-mail is incorrect!');
   
    }
    
  }
  
  
 public function submitForm(array &$form, FormStateInterface $form_state) {
     
    
    $message = 'Message: '.$form_state->getValue('message');

    $message = wordwrap($message, 70, "\r\n");
    
    $subject = $form_state->getValue('subject');
    
    $newMail = mail('nataly.ismailova@mail.ru', $subject, $message);
    
    
    /*
    $mailManager = \Drupal::service('plugin.manager.mail');
    $module = 'my_form';
    $key = 'send_mail';
    $to = 'natashka5108964@mail.ru';
    $params['mail_title'] = 'a title';
    $params['message'] = 'a message';
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;
    $newMail = $mailManager->mail($module, $key, $to, $langcode, $params, null, $send);
    var_dump($newMail);
    */
    
    /*
    $send_mail = \Drupal::service('plugin.manager.mail');
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $params['context']['subject'] = "Subject";
    $params['context']['message'] = 'body';
    $to = "natashka5108964@mail.ru";
    $send_mail->mail('system', 'mail', $to, $langcode, $params);
    //print_r($send_mail);
    */
    
    /*
    $newMail = \Drupal::service('plugin.manager.mail');
    $params['subject'] = 'Subject';
    $params['body'] = $form_state->getValue('message');
    $newMail->mail('my_form', 'submit', 'natashka5108964@mail', 'ru', $params, $reply = NULL, $send = TRUE);
    */
    
    /*
    $email_address = 'natashka5108964@mail.ru';
 
    $send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail();
    $from = 'your@site.com';
    $message['headers'] = array(
      'content-type' => 'text/html',
      'MIME-Version' => '1.0',
      'reply-to' => $from,
      'from' => 'Name site<'.$from.'>'
    );
    $message['to'] = $email_address;
    $message['subject'] = "Your Subject";
    $message['body'] = 'Your Body';
    $newMail = $send_mail->mail($message);
    */
    
    
    
    
    if($newMail) {
        
        \Drupal::logger('my_form')->notice('Mail is sent. E-mail: '.$form_state->getValue('email'));
    
        drupal_set_message('E-mail is sent!');

    }
    
    
    $email = $form_state->getValue('email');
    $firstname = $form_state->getValue('first_name');
    $lastname = $form_state->getValue('last_name');
    
    
    $url = "https://api.hubapi.com/contacts/v1/contact/createOrUpdate/email/".$email."/?hapikey=62c6e162-1f3e-40eb-aa07-d0a31a5aa131";
    
    $data = array(
      'properties' => [
        [
          'property' => 'firstname',
          'value' => $firstname
        ],
        [
          'property' => 'lastname',
          'value' => $lastname 
        ]
      ]
    );
    
    
    $json = json_encode($data,true);
    
    $response = \Drupal::httpClient()->post($url.'&_format=hal_json', [
      'headers' => [
        'Content-Type' => 'application/json'
      ],
        'body' => $json
    ]);
    
 }
 
}