<?php

namespace Drupal\twig_extensions;

use Drupal\Core\Site\Settings;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

/**
 * Registers the twig services.
 */
class TwigExtensionsServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    parent::register($container);
    if (Settings::get('twig_extensions_array', FALSE)) {
      $container->register('twig_extensions.twig.array', '\Twig_Extensions_Extension_Array')
        ->addTag('twig.extension');
    }
    if (Settings::get('twig_extensions_date', FALSE)) {
      $container->register('twig_extensions.twig.date', '\Twig_Extensions_Extension_Date')
        ->addTag('twig.extension');
    }
    // Ensure the Intl PHP extension is available before adding the service
    if (class_exists('IntlDateFormatter') && Settings::get('twig_extensions_intl', FALSE)) {
      $container->register('twig_extensions.twig.intl', '\Twig_Extensions_Extension_Intl')
        ->addTag('twig.extension');
    }
    if (Settings::get('twig_extensions_i18n', FALSE)) {
      $container->register('twig_extensions.twig.i18n', '\Twig_Extensions_Extension_I18n')
        ->addTag('twig.extension');
    }
    if (Settings::get('twig_extensions_text', TRUE)) {
      $container->register('twig_extensions.twig.text', '\Twig_Extensions_Extension_Text')
        ->addTag('twig.extension');
    }
  }

}
