<?php
/**
 * Class AbstractFieldMapperDescriptor
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\FieldMapper;

use AdminProject\AdminBundle\Admin\AbstractAdmin;

/**
 * Class AbstractFieldMapperDescriptor
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
abstract class AbstractFieldMapperDescriptor implements FieldMapperDescriptorInterface
{
    /**
     * Saves the abstract admin.
     * @var AbstractAdmin
     */
    protected $admin;

    /**
     * Saves the field name.
     * @var string
     */
    protected $name;

    /**
     * Saves the type.
     * @var string
     */
    protected $type;

    /**
     * AbstractFieldMapperDescriptor constructor.
     * @param AbstractAdmin $admin
     * @param name $name
     * @param string $type
     */
    public function __construct(AbstractAdmin $admin, $name, $type)
    {
        $this->admin = $admin;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return AbstractAdmin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the admin pool.
     * @return \AdminProject\AdminBundle\Admin\Pool
     */
    private function getAdminPool()
    {
        return $this->getAdmin()->getAdminPool();
    }

    /**
     * Returns the template.
     * @return string
     */
    public function getTemplate()
    {
        return $this->getAdminPool()->getTemplate(
            sprintf(
                '%s_type_%s',
                $this->getAdmin()->getMode(),
                $this->getType()
            )
        );
    }
}