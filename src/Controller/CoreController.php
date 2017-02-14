<?php
/**
 * Class CoreController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Controller;

use AdminProject\AdminBundle\Admin\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CoreController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class CoreController extends Controller
{
    /**
     * Renders the dashboard.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return $this->render($this->getAdminPool()->getTemplate('dashboard'), [
            'layout'     => $this->getLayoutTemplate(),
            'admin_pool' => $this->getAdminPool()
        ]);
    }



    /**
     * Returns the admin pool
     * @return Pool
     */
    protected function getAdminPool()
    {
        return $this->get('adminproject.admin.pool');
    }

    /**
     * Returns the layout template
     * @return string
     */
    protected function getLayoutTemplate()
    {
        return $this->getAdminPool()->getTemplate('layout');
    }
}
