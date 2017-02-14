<?php
/**
 * Class AdminProjectAdminBundle
 * @package AdminProject\AdminBundle
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle;

use AdminProject\AdminBundle\DependencyInjection\Compiler\AdminServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AdminProjectAdminBundle
 * @package AdminProject\AdminBundle
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class AdminProjectAdminBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AdminServiceCompilerPass());
    }
}
