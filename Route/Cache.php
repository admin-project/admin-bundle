<?php
/**
 * Class Cache
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use AdminProject\AdminBundle\Route\Builder\AdminRouteCollection;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class Cache
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class Cache
{
    /**
     * Saves the folder
     * @var string
     */
    private $folder;

    /**
     * Saves the debug state.
     * @var bool
     */
    private $debug;

    /**
     * Cache constructor.
     * @param string $folder
     * @param bool $debug
     */
    public function __construct($folder, $debug)
    {
        $this->folder = $folder;
        $this->debug = $debug;
    }

    /**
     * Loads the route cache
     * @param AbstractAdmin $admin
     * @return AdminRouteCollection
     */
    public function load(AbstractAdmin $admin)
    {
        $cacheFileName = $this->folder . '/route_' . md5($admin->getCode());
        $cache         = new ConfigCache($cacheFileName, $this->debug);

        if (!$cache->isFresh()) {
            $cache->write(serialize($admin->getRoutes()));
        }

        return unserialize(file_get_contents($cacheFileName));
    }
}