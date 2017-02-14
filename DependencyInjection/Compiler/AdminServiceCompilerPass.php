<?php
/**
 * Class AdminServiceCompilerPass
 * @package AdminProject\AdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AdminServiceCompilerPass
 * @package AdminProject\AdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class AdminServiceCompilerPass implements CompilerPassInterface
{
    /**
     * Process the compiler pass.
     * @param ContainerBuilder $container
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('adminproject.admin.pool')) {
            return;
        }

        $definition = $container->findDefinition('adminproject.admin.pool');

        $taggedServices = $container->findTaggedServiceIds('adminproject.adminservice');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addAdminService', array(new Reference($id)));

            $service = $container->getDefinition($id);
            $service->addMethodCall('setAdminPool', [new Reference('adminproject.admin.pool')]);

            foreach ($tags as $tag) {
                if (isset($tag['group'])) {
                    $service->addMethodCall('addGroup', [$tag['group']]);
                }
                if (isset($tag['label'])) {
                    $service->addMethodCall('setLabel', [$tag['label']]);
                }
            }
        }
    }
}