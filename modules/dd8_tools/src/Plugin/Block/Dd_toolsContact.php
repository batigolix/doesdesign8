<?php

/**
 * @file
 * Contains \Drupal\dd8_tools\Plugin\Block\Dd_toolsContact .
 */

namespace Drupal\dd8_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

//use Drupal\my_module\MyEntityInterface;

/**
 * Provides a 'Example: configurable text string' block.
 *
 * @Block(
 *   id = "contact",
 *   subject = @Translation("Contact"),
 *   admin_label = @Translation("DD 8 tools: Contact"),
 * )
 */
class Dd_toolsContact extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {


    $socials = array(
      array(
        'name' => 'Facebook',
        'img' => 'facebook-logo.png',
        'cta' => $this-t('Visit Doesdesign at Facebook'),
        'url' => 'https://www.facebook.com/Doesdesign.nl',
        'class' => 'facebook',
      ),
      array(
        'name' => 'Linkedin',
        'img' => 'linkedin-logo.png',
        'cta' => $this-t('Visit Birigit at Linkedin'),
        'url' => 'http://nl.linkedin.com/in/birgitdoesborg',
        'class' => 'linkedin',
      ),
      array(
        'name' => 'Twitter',
        'img' => 'twitter-logo.png',
        'cta' => $this-t('Tweet Birigit'),
        'url' => 'http://twitter.com/#!/Doesdesign_nl',
        'class' => 'twitter',
      ),
      array(
        'name' => 'YouTube',
        'cta' => $this->t('Visit YouTube page'),
        'img' => 'youtube-logo.png',
        'url' => 'http://www.youtube.com/user/metalartcreations',
        'class' => 'youtube',
      ),
    );
    $img_path = drupal_get_path('theme', 'shakudo') . '/images/';
    $items = array();
    foreach ($socials as $social) {
      $img = array(
        '#theme' => 'image',
        '#uri' => $img_path . $social['img'],
        '#title' => $social['cta'],
        '#alt' => $social['name'],
      );
      $url = Url::fromUri($social['url']);
      $url->setOptions(array(
        'attributes' => array(
          'title' => $social['cta'],
          'class' => array($social['class']),
        ),
      ));
      $items[] = \Drupal::l($img, $url);
    }
    $build['doespic'] = array(
      '#theme' => 'image',
      '#path' => $img_path . 'Doesklein.jpg',
      '#width' => '75',
      '#height' => '100',
      '#attributes' => array(
        'class' => array(
          'doespic'
        ),
        'title' => 'Birgit Doesborg',
        'alt' => 'Foto Birgit Doesborg',
      ),
    );
//    $build['about']['#markup'] = '<div class="about"><strong>' . l('Birgit Doesborg', 'about') . '</strong>, Goud- en zilversmid.</div>';
//    $build['contact_link']['#markup'] = '<div class="contact"><strong>' . l('Contact', 'contact') . '</strong></div>';
    $build['social'] = array(
      '#theme' => 'item_list',
      '#items' => $items,
      '#attributes' => array('class' => array('socialist')),
    );


    return $build;
//
  }

}
