<?php
/**
 * Class AdminServiceCompilerPass
 * @package AdminProject\AdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
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
            $definition->addMethodCall('addAdminService', array($id, new Reference($id)));

            $service = $container->getDefinition($id);
            $service->addMethodCall('setAdminPool',             [new Reference('adminproject.admin.pool')]);
            $service->addMethodCall('setCode',                  [$id]);
            $service->addMethodCall('setDefaultControllerName', ['AdminProjectAdminBundle:CRUD']);
            $service->addMethodCall('setDefaultAction',         ['list']);

            foreach ($tags as $tag) {
                if (isset($tag['group'])) {
                    $service->addMethodCall('addGroup', [$tag['group']]);
                }
                if (isset($tag['label'])) {
                    $service->addMethodCall('setLabel', [$tag['label']]);
                }

                if (isset($tag['manager_type'])) {
                    $this->applyModelManager($container, $service, $tag['manager_type']);
                } else {
                    throw new \Exception('manager_type must be given for service ' . $id);
                }
            }
        }
    }

    /**
     * Apply the model manager.
     * @param ContainerBuilder $container
     * @param Definition       $service
     * @param string           $managerType
     * @throws \Exception
     */
    private function applyModelManager(ContainerBuilder $container, Definition $service, $managerType)
    {
        $managerTypeServiceId = sprintf('adminproject.manager.%s', $managerType);
        if (!$container->has($managerTypeServiceId)) {
            throw new \Exception('Model Manager ' . $managerTypeServiceId . ' not found');
        }

        $service->addMethodCall('setModelManager',       [new Reference($managerTypeServiceId)]);
        $service->addMethodCall('setDatagridBuilder',    [new Reference(sprintf('adminproject.builder.%s_datagrid', $managerType))]);
        $service->addMethodCall('setFieldmapperBuilder', [new Reference(sprintf('adminproject.builder.%s_fieldmapper', $managerType))]);
    }
}