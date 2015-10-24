<?php

/**
 * @file
 * Contains \Drupal\dd8_tools\Plugin\Block\Dd_toolsSlideshow .
 */

namespace Drupal\dd8_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
//use Drupal\Core\Entity\EntityViewBuilder;


/**
 * Provides a 'Example: configurable text string' block.
 *
 * @Block(
 *   id = "slideshow",
 *   subject = @Translation("Slideshow"),
 *   admin_label = @Translation("DD 8 tools: Slideshow")
 * )
 */
class Dd_toolsSlideshow extends BlockBase {

  /**
   * Overrides \Drupal\Core\Block\BlockBase::defaultConfiguration().
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Slideshow"),
      'content' => t(''),
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
    $form['slideshow_items'] = array(
      '#type' => 'select',
      '#title' => t('Number of items in slideshow'),
      '#options' => array(
        3 => 3,
        5 => 5,
        7 => 7,
        9 => 9,
        11 => 11,
        13 => 13,
        15 => 15,
        17 => 17,
      ),
      '#description' => t('This number of items will be shown in the slideshow block'),
      '#default_value' => $config['slideshow_items'],
    );
    $form['slideshow_order'] = array(
      '#type' => 'select',
      '#title' => t('Order'),
      '#options' => array('ASC ' => t('Ascending'), 'DESC' => t('Descending')),
      '#description' => t('In what order the items will be shown in the slideshow block'),
      '#default_value' => $config['slideshow_order'],
    );
    $form['slideshow_order_prop'] = array(
      '#type' => 'select',
      '#title' => t('Order by'),
      '#options' => array(
        'created ' => t('Creation date'),
        'changed' => t('Date of last change')
      ),
      '#description' => t('By which date the items will be ordered in the slideshow block'),
      '#default_value' => $config['slideshow_order_prop'],
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['slideshow_items'] = $form_state->getValue('slideshow_items');
  }


  /**
   * Implements \Drupal\Core\Block\BlockBase::blockBuild().
   */
  public function build() {
    $slideshow_items = $this->configuration['slideshow_items'];


    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'object');
//      ->condition('changed', REQUEST_TIME, '<')
//      ->condition('title', 'cat', 'CONTAINS')
//      ->condition('field_tags.entity.name', 'cats');

    $nids = $query->execute();

    dd($nids);
    $nodes = entity_load_multiple('node', $nids);

    foreach ($nodes as $node) {
      $entity_view = entity_view($node, 'teaser');
      $items[] = array(
        'data' => drupal_render($entity_view),
        'class' => array('slide')
      );
    }

    $view_builder = \Drupal::entityManager()->getViewBuilder('node');

    $full_output = $view_builder->view($entity);

    $rss_output = $view_builder->view($entity, 'rss');

    $build = array();


    $build['list'] = [
      '#theme' => 'item_list',
      '#items' => $items,
    ];


//    $build = array(
//      '#markup' => theme('item_list', array(
//        'items' => $items,
//        'title' => NULL,
//        'type' => 'ul',
//        'attributes' => array('class' => array('rslides')),
//      ))
//    );
dpm($build);

//    $build['container']['#markup'] = '<div id="flickr_images">sdfsdf </div>';

    $build['#attached']['library'][] = 'dd8_tools/slideshow';
    $build['#attached']['library'][] = 'dd8_tools/responsiveslides';
    $build['#attached']['drupalSettings']['dd8_tools']['slideshow']['slideshow_items'] = $slideshow_items;

    return $build;
  }

}
