<?php
/**
 * Class AdminServiceCompilerPass
 * @package AdminProject\AdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\DependencyInjection\Compiler;

use AdminProject\AdminBundle\Exception\Model\ModelManagerNotConfiguredForAdminService;
use AdminProject\AdminBundle\Exception\Model\ModelManagerNotFoundException;
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
     * @throws ModelManagerNotFoundException
     * @throws ModelManagerNotConfiguredForAdminService
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

            $adminService = $container->getDefinition($id);
            $adminService->addMethodCall('setAdminPool',             [new Reference('adminproject.admin.pool')]);
            $adminService->addMethodCall('setCode',                  [$id]);
            $adminService->addMethodCall('setDefaultControllerName', ['AdminProjectAdminBundle:CRUD']);
            $adminService->addMethodCall('setDefaultAction',         ['list']);

            foreach ($tags as $tag) {
                $this->applyAdminServiceTag($adminService, $tag);

                if (isset($tag['manager_type'])) {
                    $this->applyModelManager($container, $adminService, $tag['manager_type']);
                } else {
                    throw new ModelManagerNotConfiguredForAdminService(sprintf(
                        'manager_type must be given for service "%s"',
                        $id
                    ));
                }
            }
        }
    }

    /**
     * Apply the tags for the admin service.
     * @param Definition $adminService
     * @param array      $tag
     * @return void
     */
    private function applyAdminServiceTag(Definition $adminService, array $tag)
    {
        $tagMapping = [
            'group' => 'addGroup',
            'label' => 'setLabel'
        ];

        foreach ($tagMapping as $tagName => $methodName) {
            if (isset($tag[$tagName])) {
                $adminService->addMethodCall($methodName, [$tag[$tagName]]);
            }
        }
    }

    /**
     * Apply the model manager.
     * @param ContainerBuilder $container
     * @param Definition       $adminService
     * @param string           $managerType
     * @return void
     * @throws ModelManagerNotFoundException
     */
    private function applyModelManager(ContainerBuilder $container, Definition $adminService, $managerType)
    {
        $managerTypeServiceId = sprintf('adminproject.manager.%s', $managerType);

        if (!$container->has($managerTypeServiceId)) {
            throw new ModelManagerNotFoundException('Model Manager ' . $managerTypeServiceId . ' not found');
        }

        $adminService->addMethodCall(
            'setModelManager',
            [
                new Reference($managerTypeServiceId)
            ]
        );

        foreach ($this->getModelManagerServicesMapping() as $serviceName => $method) {
            $adminService->addMethodCall(
                $method,
                [
                    new Reference(sprintf('adminproject.builder.%s_%s', $managerType, $serviceName))
                ]
            );
        }
    }

    /**
     * Returns the additional model manager services mapping to inject in admin service.
     * @return array
     */
    private function getModelManagerServicesMapping()
    {
        return [
            'datagrid' => 'setDatagridBuilder',
            'fieldmapper' => 'setFieldmapperBuilder'
        ];
    }
}