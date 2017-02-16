<?php
/**
 * Interface QueryProxyInterface
 * @package AdminProject\AdminBundle\Model\Proxy
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Model\Proxy;

/**
 * Interface QueryProxyInterface
 * @package AdminProject\AdminBundle\Model\Proxy
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface QueryProxyInterface
{
    /**
     * Calls the query method.
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call($name, array $arguments);

    /**
     * Executes the query.
     * @param array $params
     * @param null  $hydrationMode
     * @return mixed
     */
    public function execute(array $params = array(), $hydrationMode = null);

    /**
     * Sets the first result.
     * @param int $firstResult
     * @return void
     */
    public function setFirstResult($firstResult);

    /**
     * Sets the max results.
     * @param int $maxResults
     * @return void
     */
    public function setMaxResults($maxResults);
}