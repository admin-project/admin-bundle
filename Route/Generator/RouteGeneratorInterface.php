<?php
/**
 * Interface RouteGeneratorInterface
 * @package AdminProject\AdminBundle\Route\Generator
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Route\Generator;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Interface RouteGeneratorInterface
 * @package AdminProject\AdminBundle\Route\Generator
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface RouteGeneratorInterface
{
    /**
     * Generates the url.
     * @param AbstractAdmin $admin
     * @param string        $action
     * @param array         $parameters
     * @param int           $absolute
     * @return string
     */
    public function generateUrl(AbstractAdmin $admin, $action, array $parameters = [], $absolute = UrlGeneratorInterface::ABSOLUTE_PATH);
}