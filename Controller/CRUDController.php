<?php
/**
 * Class CRUDController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Controller;

use AdminProject\AdminBundle\Admin\AbstractAdmin;


/**
 * Class CRUDController
 * @package AdminProject\AdminBundle\Controller
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class CRUDController extends CoreController
{
    /**
     * Saves the admin instance.
     * @var AbstractAdmin
     */
    private $admin;

    /**
     * Configures the request.
     */
    protected function configure()
    {
        $adminCode   = $this->getAdminCode();
        $this->admin = $this->getAdminPool()->getAdminServiceByCode($adminCode);
    }

    /**
     * Returns the default parameters.
     * @return array
     */
    protected function getDefaultParameters()
    {
        return array_merge(parent::getDefaultParameters(), [
            'admin'              => $this->admin,
            'translation_domain' => $this->admin->getTranslationDomain()
        ]);
    }

    /**
     * Default list action.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $this->configure();

        $this->admin->setMode(AbstractAdmin::MODE_LIST);

        return $this->render(
            $this->getAdminPool()->getTemplate('list'),
            array_merge(
                [
                    'action'   => 'list',
                    'datagrid' => $this->admin->getDatagrid()
                ],
                $this->getDefaultParameters()
            ));
    }

    /**
     * Returns the admin code.
     * @return string
     */
    protected function getAdminCode()
    {
        if ($this->getRequest()->get('_project_admin')) {
            return $this->getRequest()->get('_project_admin');
        }
    }
}