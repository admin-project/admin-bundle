<?php
/**
 * This is the class that loads and manages your bundle configuration.
 * @package AdminProject\AdminBundle\DependencyInjection
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 * @package AdminProject\AdminBundle\DependencyInjection
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class AdminProjectAdminExtension extends Extension
{
    /**
     * Loads a specific configuration.
     * @param array            $configs   An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadConfiguration($container);

        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);

        $config['options']['javascripts'] = $config['assets']['javascripts'];
        $config['options']['stylesheets'] = $config['assets']['stylesheets'];
        $config['options']['layout']      = $config['layout'];

        $pool = $container->getDefinition('adminproject.admin.pool');
        $pool->replaceArgument(1, $config['title']);
        $pool->replaceArgument(2, $config['title_logo']);
        $pool->replaceArgument(3, $config['options']);

        $container->setParameter('adminproject.admin.configuration.templates', $config['templates']);
        $container->setParameter('adminproject.admin.configuration.options',   $config['options']);
        $container->setParameter('adminproject.admin.configuration.groups',    $config['groups']);
    }

    /**
     * Loads the configuration files.
     * @param ContainerBuilder $containerBuilder
     * @return void
     */
    private function loadConfiguration(ContainerBuilder $containerBuilder)
    {
        $loader = new Loader\YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('core.yml');
        $loader->load('menu.yml');
        $loader->load('router.yml');
        $loader->load('twig.yml');
        $loader->load('model.yml');
    }
}
