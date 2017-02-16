<?php
/**
 * Class DatagridBuilderInterface
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use AdminProject\AdminBundle\Admin\AbstractAdmin;

/**
 * Class DatagridBuilderInterface
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface DatagridBuilderInterface
{
    /**
     * Creates the base datagrid.
     * @param AbstractAdmin $admin
     * @param array         $parameters
     * @param string        $pagerType
     * @return Datagrid
     */
    public function createBaseDatagrid(AbstractAdmin $admin, array $parameters = [], $pagerType = PagerInterface::PAGER_TYPE_SIMPLE);
}