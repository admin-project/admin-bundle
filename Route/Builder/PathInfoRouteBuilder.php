<?php
/**
 * Class PathInfoRouteBuilder
 * @package AdminProject\AdminBundle\Route\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route\Builder;

use AdminProject\AdminBundle\Admin\AbstractAdmin;

/**
 * Class PathInfoRouteBuilder
 * @package AdminProject\AdminBundle\Route\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class PathInfoRouteBuilder
{
    /**
     * Builds the routes.
     * @param AbstractAdmin        $admin
     * @param AdminRouteCollection $collection
     */
    public function build(AbstractAdmin $admin, AdminRouteCollection $collection)
    {
        $collection
            ->add('list')
            ->add('create')
            ->add('edit',   '{id}/edit')
            ->add('show',   '{id}/show')
            ->add('delete', '{id}/delete')
        ;
    }
}