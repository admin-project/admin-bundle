<?php
/**
 * Class AdminRouteLoader
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route;

use AdminProject\AdminBundle\Admin\Pool;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class AdminRouteLoader
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class AdminRouteLoader extends Loader
{
    /**
     * Saves the pool.
     * @var Pool
     */
    private $pool;

    /**
     * AdminRouteLoader constructor.
     * @param Pool $pool
     */
    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     * @param string|null $type The resource type or null if unknown
     *
     * @throws \Exception If something went wrong
     */
    public function load($resource, $type = null)
    {
        $collection = new RouteCollection();

        foreach ($this->pool->getAdminServices() as $admin) {

            foreach ($admin->getRoutes()->all() as $name => $route) {
                $collection->add($name, $route);
            }

        }

        return $collection;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed $resource A resource
     * @param string|null $type The resource type or null if unknown
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return $type == 'admin_project';
    }
}