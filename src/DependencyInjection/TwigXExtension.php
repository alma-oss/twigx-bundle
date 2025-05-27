<?php

declare(strict_types=1);

namespace AlmaCareer\TwigXBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TwigXExtension extends Extension
{
    public const PARAMETER_PATHS = 'twigx.paths';

    public const PARAMETER_PATH_ALIAS = 'twigx.paths_alias';

    public const DEFAULT_COMPONENTS_PATH = __DIR__ . '';

    public const DEFAULT_PATH_ALIAS = 'spirit';

    public const DEFAULT_PARTIALS_PATH = __DIR__ . '';

    public const DEFAULT_PARTIALS_ALIAS = 'partials';

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter(self::PARAMETER_PATHS, array_merge($config['paths'], [self::DEFAULT_COMPONENTS_PATH]));
        $container->setParameter(self::PARAMETER_PATH_ALIAS, $config['paths_alias']);
    }
}
