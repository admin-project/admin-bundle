<?php
/**
 * Admin Pool Class
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Admin;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Admin Pool Class
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class Pool
{

    /**
     * Saves the container.
     * @var ContainerInterface
     */
    private $container;

    /**
     * Saves the title.
     * @var string
     */
    private $title;

    /**
     * Saves the title logo.
     * @var string
     */
    private $titleLogo;

    /**
     * Saves the options.
     * @var array
     */
    private $options = [];

    /**
     * Saves the admin services.
     * @var AbstractAdmin[]
     */
    private $adminServices = [];

    /**
     * Saves the templates.
     * @var array
     */
    private $templates;

    /**
     * Pool constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container, $title, $titleLogo, array $options)
    {
        $this->container = $container;
        $this->title     = $title;
        $this->titleLogo = $titleLogo;
        $this->options   = $options;
    }

    /**
     * Returns the container.
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Returns the translator.
     * @return \Symfony\Component\Translation\IdentityTranslator
     */
    public function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * Sets the templates
     * @param array $templates
     * @return void
     */
    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
    }

    /**
     * Adds a admin service.
     * @param string        $code
     * @param AbstractAdmin $adminService
     * @return void
     */
    public function addAdminService($code, AbstractAdmin $adminService)
    {
        $this->adminServices[$code] = $adminService;
    }

    /**
     * Returns the template
     * @param $template
     * @return string
     */
    public function getTemplate($template)
    {
        return $this->templates[$template];
    }

    /**
     * Returns the option.
     * @param string $option
     * @param mixed  $default
     * @return bool|mixed
     */
    public function getOption($option, $default = null)
    {
        if (isset($this->options[$option])) {
            return $this->options[$option];
        }

        if (null !== $default) {
            return $default;
        }

        return false;
    }

    /**
     * Returns a layout option.
     * @param string $option
     * @return bool|mixed
     */
    public function getLayoutOption($option)
    {
        $layoutOptions = $this->getOption('layout', []);
        if (isset($layoutOptions[$option])) {
            return $layoutOptions[$option];
        }

        return false;
    }

    /**
     * Returns the entities configuation
     * @return AbstractAdmin[]
     */
    public function getAdminServices()
    {
        return $this->adminServices;
    }

    /**
     * Returns the admin service by code.
     * @param string $code
     * @return AbstractAdmin
     */
    public function getAdminServiceByCode($code)
    {
        return $this->adminServices[$code];
    }

    /**
     * Returns the admin services for given group.
     * @param string $group
     * @return AbstractAdmin[]
     */
    public function getAdminServicesForGroup($group)
    {
        $adminServices = [];

        foreach ($this->adminServices as $adminService) {
            if (in_array($group, $adminService->getGroups())) {
                $adminServices[] = $adminService;
            }
        }

        return $adminServices;
    }

    /**
     * Returns the admin Groups.
     * @return array
     */
    public function getAdminGroups()
    {
        return $this->container->getParameter('adminproject.admin.configuration.groups');
    }
}