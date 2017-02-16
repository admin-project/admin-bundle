<?php
/**
 * Class Datagrid
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use AdminProject\AdminBundle\Model\Proxy\QueryProxyInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class Datagrid
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class Datagrid
{
    /**
     * Saves the model manager.
     * @var QueryProxyInterface
     */
    private $query;

    /**
     * Saves the pager
     * @var PagerInterface
     */
    private $pager;

    /**
     * Checks if the pager was built.
     * @var boolean
     */
    private $pagerBuilt = false;

    /**
     * Saves the form builder for filter.
     * @var FormBuilderInterface
     */
    private $filterFormBuilder;

    /**
     * Saves the parameters.
     * @var array
     */
    private $parameters = [];

    /**
     * Saves the form.
     * @var Form
     */
    private $filterForm;

    /**
     * Saves the results.
     * @var array
     */
    private $results;

    /**
     * Datagrid constructor.
     * @param QueryProxyInterface  $query
     * @param PagerInterface       $pager
     * @param FormBuilderInterface $filterFormBuilder
     * @param array                $parameters
     */
    public function __construct(QueryProxyInterface $query, PagerInterface $pager, FormBuilderInterface $filterFormBuilder, array $parameters = [])
    {
        $this->query             = $query;
        $this->pager             = $pager;
        $this->filterFormBuilder = $filterFormBuilder;
        $this->parameters        = $parameters;
    }

    /**
     * Returns the results.
     * @return array
     */
    public function getResults()
    {
        $this->buildPager();

        if (!$this->results) {
            $this->results = $this->pager->getResults();
        }
        return $this->results;
    }

    /**
     * Returns the filter form.
     * @return Form
     */
    public function getFilterForm()
    {
        $this->buildPager();

        return $this->filterForm;
    }

    /**
     * Returns the pager.
     * @return PagerInterface
     */
    public function getPager()
    {
        $this->buildPager();

        return $this->pager;
    }

    /**
     * Builds the pager.
     * @return void
     */
    private function buildPager()
    {
        if (!$this->pagerBuilt) {
            $maxPerPage = 25;
            $page = 1;

            $this->filterFormBuilder->add('_sort_by');
            $this->filterFormBuilder->add('_page');
            $this->filterFormBuilder->add('_per_page');

            $this->filterForm = $this->filterFormBuilder->getForm();
            $this->filterForm->submit($this->parameters);

            if (isset($this->parameters['_per_page'])) {
                $maxPerPage = $this->parameters['_per_page'];
            }

            if (isset($this->parameters['_page'])) {
                $page = $this->parameters['_page'];
            }

            $this->pager->setMaxPerPage($maxPerPage);
            $this->pager->setPage($page);
            $this->pager->setQuery($this->query);
            $this->pager->init();


            $this->pagerBuilt = true;
        }
    }
}