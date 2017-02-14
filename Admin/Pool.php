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
     * Sets the templates
     * @param array $templates
     * @return void
     */
    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
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
}