<?php
/**
 * Class FieldMapper
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\FieldMapper;

/**
 * Class FieldMapper
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class FieldMapper
{
    /**
     * Saves the fields.
     * @var AbstractFieldMapperDescriptor[]
     */
    private $fields;

    /**
     * Adds a field.
     * @param AbstractFieldMapperDescriptor $descriptor
     * @return FieldMapper
     */
    public function addField(AbstractFieldMapperDescriptor $descriptor)
    {
        $this->fields[] = $descriptor;
        return $this;
    }

    /**
     * Returns all
     * @return array
     */
    public function all()
    {
        return $this->fields;
    }
}