<?php
/**
 * This is the class that validates and merges configuration from your app/config files.
 * @package AdminProject\AdminBundle\DependencyInjection
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 * @package AdminProject\AdminBundle\DependencyInjection
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('admin_project_admin');

        $rootNode
            ->children()
                ->scalarNode('title')->defaultValue('Admin')->cannotBeEmpty()->end()
                ->scalarNode('title_logo')->defaultValue('Admin Logo')->cannotBeEmpty()->end()
            ->end()
        ;

        $this->addTemplateConfiguration($rootNode);
        $this->addAssetsConfiguration($rootNode);
        $this->addLayoutConfiguration($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds the template configuration
     * @param $rootNode
     */
    private function addTemplateConfiguration($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('templates')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('layout')->defaultValue('AdminProjectAdminBundle::layout.html.twig')->cannotBeEmpty()->end()
                        ->scalarNode('dashboard')->defaultValue('AdminProjectAdminBundle:Core:dashboard.html.twig')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds the template configuration
     * @param $rootNode
     */
    private function addLayoutConfiguration($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('layout')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('search')->defaultTrue()->end()
                        ->scalarNode('skin')->defaultValue('red')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds the assets configuration
     * @param $rootNode
     */
    private function addAssetsConfiguration($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('assets')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('javascripts')
                            ->defaultValue([
                                'bundles/adminprojectadmin/vendor/jquery/dist/jquery.min.js',
                                'bundles/adminprojectadmin/vendor/jquery-ui/jquery-ui.min.js',

                                'bundles/adminprojectadmin/vendor/admin-lte/dist/js/app.min.js',
                                'bundles/adminprojectadmin/vendor/admin-lte/bootstrap/js/bootstrap.min.js',
                            ])->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('stylesheets')
                            ->defaultValue([
                                'bundles/adminprojectadmin/vendor/admin-lte/bootstrap/css/bootstrap.min.css',
                                'bundles/adminprojectadmin/vendor/admin-lte/dist/css/AdminLTE.min.css',
                                'bundles/adminprojectadmin/vendor/admin-lte/dist/css/skins/_all-skins.min.css',
                                'bundles/adminprojectadmin/vendor/jquery-ui/themes/base/jquery-ui.min.css',
                                'bundles/adminprojectadmin/vendor/components-font-awesome/css/font-awesome.min.css',
                            ])->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
