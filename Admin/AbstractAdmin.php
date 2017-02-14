<?php
/**
 * Class AbstractAdmin
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Admin;

/**
 * Class AbstractAdmin
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
abstract class AbstractAdmin
{
    /**
     * Saves the admin pool
     * @var Pool
     */
    private $pool;

    /**
     * Saves the groups
     * @var array
     */
    private $groups = [];

    /**
     * Defines the label
     * @var string
     */
    protected $label;

    /**
     * Saves the translation domain for this admin.
     * @var string
     */
    protected $translationDomain = 'messages';

    /**
     * Sets the admin pool
     * @param Pool $pool
     * @return void
     */
    final public function setAdminPool(Pool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * Sets the groups
     * @param array $groups
     * @return void
     */
    final public function setGroups(array $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Adds a group.
     * @param string $group
     * @return void
     */
    final public function addGroup($group)
    {
        $this->groups[] = $group;
    }

    /**
     * Sets the label
     * @param string $label
     * @return void
     */
    final public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Sets the translation domain.
     * @param string $translationDomain
     * @return void
     */
    final public function setTranslationDomain($translationDomain)
    {
        $this->translationDomain = $translationDomain;
    }

    /**
     * Returns the groups.
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Returns the admin pool.
     * @return Pool
     */
    protected function getAdminPool()
    {
        return $this->pool;
    }

    /**
     * Returns the label.
     * @return string
     */
    public function getLabel()
    {
        return ($this->label ? $this->label : $this->getClassName());
    }

    /**
     * Returns the translation domain.
     * @return string
     */
    public function getTranslationDomain()
    {
        return $this->translationDomain;
    }

    /**
     *
     */
    public function getClassName()
    {
        $class = explode('\\', get_called_class());
        return end($class);
    }
}