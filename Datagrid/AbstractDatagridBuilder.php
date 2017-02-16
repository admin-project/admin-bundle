<?php
/**
 * Class AbstractDatagridBuilder
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Class AbstractDatagridBuilder
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
abstract class AbstractDatagridBuilder implements DatagridBuilderInterface
{
    /**
     * Saves the form factory.
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * AbstractDatagridBuilder constructor.
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * Returns the form builder interface for filter.
     * @return FormBuilderInterface
     */
    protected function getFilterFormBuilder()
    {
        return $this->formFactory->createNamedBuilder('filter');
    }
}