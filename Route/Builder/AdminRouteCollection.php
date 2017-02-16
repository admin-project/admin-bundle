<?php
/**
 * Class RouteCollection
 * @package AdminProject\AdminBundle\Route\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route\Builder;

use Symfony\Component\Routing\Route;

/**
 * Class RouteCollection
 * @package AdminProject\AdminBundle\Route\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class AdminRouteCollection implements \Serializable
{
    /**
     * Saves the base route pattern.
     * @var string
     */
    private $routeBasePattern;

    /**
     * Saves the base route controller.
     * @var string
     */
    private $routeBaseController;

    /**
     * Saves the base route code.
     * @var string
     */
    private $routeBaseCode;

    /**
     * Saves the routes.
     * @var array
     */
    private $routes;

    /**
     * AdminRouteCollection constructor.
     * @param string $routeBasePattern
     * @param string $routeBaseController
     * @param string $routeBaseCode
     */
    public function __construct($routeBasePattern, $routeBaseController, $routeBaseCode)
    {
        $this->routeBasePattern    = $routeBasePattern;
        $this->routeBaseController = $routeBaseController;
        $this->routeBaseCode       = $routeBaseCode;
    }

    /**
     * Returns a new route.
     * @param string $name
     * @param string $pattern
     * @param array  $defaults
     * @return AdminRouteCollection
     */
    public function add($name, $pattern = null, array $defaults = [])
    {
        $pattern = $this->routeBasePattern . '/' . ($pattern ?: $name);

        if (!isset($defaults['_controller'])) {
            $defaults['_controller'] = $this->routeBaseController . ':' . $this->actionify($name);
        }

        if (!isset($defaults['_project_admin'])) {
            $defaults['_project_admin'] = $this->routeBaseCode;
        }

        $this->routes[$this->getCode($name)] = function () use (
            $pattern, $defaults
        ) {
            return new Route($pattern, $defaults);
        };


        return $this;
    }

    /**
     * Returns the code.
     * @param string $name
     * @return string
     */
    private function getCode($name)
    {
        return $this->routeBaseCode . '_' . $name;
    }

    /**
     * Create the action name for the controller method.
     * @param string $action
     * @return string
     */
    private function actionify($action)
    {
        return sprintf('%s', strtolower($action));
    }

    /**
     * Returns all routes.
     * @return array
     */
    public function all()
    {
        return array_map([$this, 'resolve'], $this->routes);
    }

    /**
     * Returns the route for given code.
     * @param string $code
     * @return bool|Route
     */
    public function getRoute($code)
    {
        if (isset($this->routes[$code])) {
            return $this->resolve($this->routes[$code]);
        }

        return false;
    }

    /**
     * Returns the route.
     * @param callable|Route $route
     * @return Route
     */
    private function resolve($route)
    {
        if (is_callable($route)) {
            return call_user_func($route);
        }
        return $route;
    }

    public function serialize()
    {
        return serialize($this->all());
    }

    public function unserialize($serialized)
    {
        $this->routes = unserialize($serialized);
    }

}