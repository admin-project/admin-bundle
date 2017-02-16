<?php
/**
 * Interface PagerInterface
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use AdminProject\AdminBundle\Model\Proxy\QueryProxyInterface;

/**
 * Interface PagerInterface
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface PagerInterface
{
    /**
     * Defines the simple pager type.
     * @var string
     */
    const PAGER_TYPE_SIMPLE = 'simple';

    /**
     * Initialize the pager.
     * @return mixed
     */
    public function init();

    /**
     * Sets the max items per page.
     * @param int $max
     * @return void
     */
    public function setMaxPerPage($max);

    /**
     * Sets the current page.
     * @param int $page
     * @return void
     */
    public function setPage($page);

    /**
     * Sets the query
     * @param QueryProxyInterface $query
     * @return void
     */
    public function setQuery(QueryProxyInterface $query);

    /**
     * Computes the number result
     * @return int
     */
    public function computeNumberResult();

    /**
     * Returns the results.
     * @return array
     */
    public function getResults();
}