<?php

/**
 * @file
 * Contains \Drupal\custom_form_in_block\Plugin\Block
 */

namespace Drupal\form_in_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'custom_form_in_block' block.
 *
 * @Block(
 *   id = "custom_form_in_block",
 *   admin_label = @Translation("Custom form in block"),
 *   category = @Translation("Example custom form in block")
 * )
 */
class FormInBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('Drupal\form_in_block\Form\FormInBlockForm');
    return $form;

  }
}