<?php
/**
 * Class Datagrid
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use Doctrine\ORM\QueryBuilder;

/**
 * Class Datagrid
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class Datagrid
{
    /**
     * Saves the model manager.
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * Saves the results.
     * @var array
     */
    private $results;

    /**
     * Datagrid constructor.
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Returns the results.
     * @return array
     */
    public function getResults()
    {
        if (!$this->results) {
            $this->results = $this->queryBuilder->getQuery()->getResult();
        }
        return $this->results;
    }

}