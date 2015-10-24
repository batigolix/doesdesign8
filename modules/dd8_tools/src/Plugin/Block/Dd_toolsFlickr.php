<?php

/**
 * @file
 * Contains \Drupal\dd8_tools\Plugin\Block\Dd_toolsFlickr .
 */

namespace Drupal\dd8_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Example: configurable text string' block.
 *
 * @Block(
 *   id = "flickr",
 *   subject = @Translation("Flickr"),
 *   admin_label = @Translation("DD 8 tools: Flickr")
 * )
 */
class Dd_toolsFlickr extends BlockBase {

  /**
   * Overrides \Drupal\Core\Block\BlockBase::defaultConfiguration().
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Photo's on Flickr"),
      'content' => t('Default demo content'),
      'cache' => array(
        'max_age' => 3600,
        'contexts' => array(
          'cache_context.user.roles',
        ),
      ),
    );
  }



  /**
   * Overrides \Drupal\Core\Block\BlockBase::blockForm().
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->configuration;
    $defaults = $this->defaultConfiguration();
    $form['flickr_items'] = array(
      '#type' => 'select',
      '#title' => t('Number of items'),
      '#options' => array(
        10 => 10,
        12 => 12,
        15 => 15,
        16 => 16,
        18 => 18,
        20 => 20
      ),
      '#description' => t('This number of items will be shown in the Flickr block'),
      '#default_value' => $config['flickr_items'],
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['flickr_items'] = $form_state->getValue('flickr_items');
  }


  /**
   * Implements \Drupal\Core\Block\BlockBase::blockBuild().
   */
  public function build() {
    $flickr_items = $this->configuration['flickr_items'];

    $build = array();
    $build['container']['#markup'] = '<div id="flickr_images">sdfsdf </div>';

    $build['#attached']['library'][] = 'dd8_tools/flickr';
    $build['#attached']['drupalSettings']['dd8_tools']['flickr']['flickr_items'] = $flickr_items;
    return $build;
  }


}
