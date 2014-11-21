<?php

/**
 * @file
 * Contains \Drupal\dd_tools\Plugin\Block\Dd_toolsNews .
 */

namespace Drupal\dd_tools\Plugin\Block;

use Drupal\Core\block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'Example: configurable text string' block.
 *
 * @Block(
 *   id = "News",
 *   subject = @Translation("News"),
 *   admin_label = @Translation("DD tools: News")
 * )
 */
class Dd_toolsNews extends BlockBase {

  /**
   * Overrides \Drupal\Core\Block\BlockBase::defaultConfiguration().
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("News"),
      'content' => t('Default news content'),
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

    $form['news_items'] = array(
      '#type' => 'select',
      '#options' => array(2 => 2, 5 => 5, 10 => 10),
      '#description' => t('This number of items will be shown in the news block'),
      '#title' => t('Number of items'),
      '#default_value' => $this->configuration['news_items'],
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

//  case 'News':
//      $blocks['subject'] = t('Photo\'s on News');
//      $blocks['content'] = array(
//        '#markup' => '<div id="News_images"> </div>',
//        '#attached' => array(
//          'js' => array(
//            'data' => drupal_get_path('module', 'dd_tools') . '/js/News.js',
//            array(
//              'data' => array(
//                'dd_tools' => array(
//                  'block_items' => variable_get('News_items', 13),
//                ),
//              ),
//              'type' => 'setting',
//            ),
//          ),
//        ),
//      );

    $build = array();
    $build['container']['#markup'] = '<div id="News_images"> </div>';
//    $test = \Drupal::config('nognix.settings')->get('doh_you');
//    $build['stuff2']['#markup'] = $this->configuration['content'];
//    $build['#attached']['library'][] = 'dd_tools/News';
    $build['#attached']['library'][] = 'dd_tools/misc';
    return $build;
  }

}
