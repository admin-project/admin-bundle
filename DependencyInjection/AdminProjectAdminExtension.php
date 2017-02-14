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
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('core.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('adminproject.admin.configuration.templates', $config['templates']);

        $config['options']['javascripts'] = $config['assets']['javascripts'];
        $config['options']['stylesheets'] = $config['assets']['stylesheets'];

        $pool = $container->getDefinition('adminproject.admin.pool');
        $pool->replaceArgument(1, $config['title']);
        $pool->replaceArgument(2, $config['title_logo']);
        $pool->replaceArgument(3, $config['options']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
