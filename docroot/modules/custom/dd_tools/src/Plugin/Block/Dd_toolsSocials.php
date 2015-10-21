<?php

/**
 * @file
 * Contains \Drupal\dd_tools\Plugin\Block\Dd_toolsFlickr .
 */

namespace Drupal\dd_tools\Plugin\Block;

use Drupal\Core\block\BlockBase;
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
   * Overrides \Drupal\Core\Block\BlockBase::blockForm().
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['content'] = array(
      '#type' => 'textfield',
      '#title' => t('Block contents'),
      '#size' => 60,
      '#description' => t('This text will appear in the demo block.'),
      '#default_value' => $this->configuration['content'],
    );


    $form['flickr_items'] = array(
        '#type' => 'select',
        '#title' => t('Number of items'),
        '#options' => array(10 => 10, 12 => 12, 15 => 15, 16 => 16, 18 => 18, 20 => 20),
        '#description' => t('This number of items will be shown in the Flickr block'),
        '#default_value' => $this->configuration['flickr_items'],
    );

    return $form;
  }

  /**
   * Overrides \Drupal\Core\Block\BlockBase::blockSubmit().
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['content'] = $form_state->getValue('content');
  }

  /**
   * Implements \Drupal\Core\Block\BlockBase::blockBuild().
   */
  public function build() {

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
    $build['container']['#markup'] = '<div id="flickr_images"> </div>';
//    $test = \Drupal::config('nognix.settings')->get('doh_you');
//    $build['stuff2']['#markup'] = $this->configuration['content'];
//    $build['#attached']['library'][] = 'dd_tools/flickr';
    $build['#attached']['library'][] = 'dd_tools/misc';
    return $build;
  }

}
