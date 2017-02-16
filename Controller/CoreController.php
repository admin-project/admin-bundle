<?php
/**
 * Class CoreController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Controller;

use AdminProject\AdminBundle\Admin\Pool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CoreController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class CoreController extends Controller
{
    /**
     * Returns the default parameters.
     * @return array
     */
    protected function getDefaultParameters()
    {
        return [
            'layout'             => $this->getLayoutTemplate(),
            'admin_pool'         => $this->getAdminPool(),
            'translation_domain' => 'messages'
        ];
    }

    /**
     * Renders the dashboard.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboardAction()
    {
        return $this->render($this->getAdminPool()->getTemplate('dashboard'), $this->getDefaultParameters());
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

    /**
     * Returns the request
     * @return Request
     */
    protected function getRequest()
    {
        if ($this->container->has('request_stack')) {
            return $this->container->get('request_stack')->getCurrentRequest();
        }

        return null;
    }
}
