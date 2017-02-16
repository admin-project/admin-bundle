<?php
/**
 * Class DefaultRouteGenerator
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Route\Generator;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class DefaultRouteGenerator
 * @package AdminProject\AdminBundle\Route
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class DefaultRouteGenerator extends AbstractRouteGenerator
{
    /**
     * Generates the url.
     * @param AbstractAdmin $admin
     * @param string        $action
     * @param array         $parameters
     * @param int           $absolute
     * @return string
     */
    public function generateUrl(AbstractAdmin $admin, $action, array $parameters = [], $absolute = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        $routeParameters = [];

        if (isset($parameters['id'])) {
            $routeParameters['id'] = $parameters['id'];

            unset($parameters['id']);
        }

        // $routeParameters['code'] = $admin->getCode();
        
        return $this->getRouter()->generate($admin->getCode() . '_' . $action, $routeParameters, $absolute);
    }
}