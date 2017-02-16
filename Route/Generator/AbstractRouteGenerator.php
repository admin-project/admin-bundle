<?php
/**
 * Class AbstractRouteGenerator
 * @package AdminProject\AdminBundle\Route\Generator
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route\Generator;
use AdminProject\AdminBundle\Admin\AbstractAdmin;
use AdminProject\AdminBundle\Route\Builder\AdminRouteCollection;
use AdminProject\AdminBundle\Route\Cache;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class AbstractRouteGenerator
 * @package AdminProject\AdminBundle\Route\Generator
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
abstract class AbstractRouteGenerator implements RouteGeneratorInterface
{
    /**
     * The router
     * @var Router
     */
    private $router;

    /**
     * Saves the routes cache instance.
     * @var Cache
     */
    private $routesCache;

    /**
     * AbstractRouteGenerator constructor.
     * @param Router $router
     * @param Cache $routesCache
     */
    public function __construct(Router $router, Cache $routesCache)
    {
        $this->router = $router;
        $this->routesCache = $routesCache;
    }

    /**
     * return the router
     * @return Router
     */
    protected function getRouter()
    {
        return $this->router;
    }

    /**
     * Returns the routes cache.
     * @return Cache
     */
    protected function getRoutesCache()
    {
        return $this->routesCache;
    }

    /**
     * Returns the routes for the admin from cache.
     * @param AbstractAdmin $admin
     * @return AdminRouteCollection
     */
    protected function getRoutesFromCache(AbstractAdmin $admin)
    {
        return $this->getRoutesCache()->load($admin);
    }
}