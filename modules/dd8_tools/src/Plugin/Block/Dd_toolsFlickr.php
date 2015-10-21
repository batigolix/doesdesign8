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
 *   admin_label = @Translation("DD tools: Flickr")
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
   * {@inheritdoc}
   */
//  public function defaultConfiguration() {
//    return [
//      'flickr_items' => 16,
//    ];
//  }


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

//  case 'flickr':
//      $blocks['subject'] = t('Photo\'s on Flickr');
//      $blocks['content'] = array(
//        '#markup' => '<div id="flickr_images"> </div>',
//        '#attached' => array(
//          'js' => array(
//            'data' => drupal_get_path('module', 'dd_tools') . '/js/flickr.js',
//            array(
//              'data' => array(
//                'dd_tools' => array(
//                  'block_items' => variable_get('flickr_items', 13),
//                ),
//              ),
//              'type' => 'setting',
//            ),
//          ),
//        ),
//      );

    $build = array();
    $build['wwwww']['#markup'] = 'ascasasd';
    $build['container']['#markup'] = '<div id="flickr_images">sdfsdf </div>';

    $build['#attached']['library'][] = 'dd8_tools/flickr';
    $build['#attached']['drupalSettings']['dd8_tools']['flickr']['flickr_items'] = $flickr_items;
//    $build['#attached']['js'][] = array(
//      'type' => 'inline',
//      'data' => "var flickr_items = $flickr_items",
//      'every_page' => TRUE,
//    );

//    $test = \Drupal::config('nognix.settings')->get('doh_you');
//    $build['stuff2']['#markup'] = $this->configuration['content'];
//    $build['#attached']['library'][] = 'dd_tools/flickr';
    $build['#attached']['library'][] = 'dd_tools/misc';
    return $build;
  }

  /**
   * {@inheritdoc}
   */
//  public function build() {
//    return array('#markup' => '<span>' . $this->t('Powered by <a href=":poweredby">Drupal</a>', array(':poweredby' => 'https://www.drupal.org')) . '</span>');
//  }
//


}
