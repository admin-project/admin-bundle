<?php
/**
 * Class FieldMapperDescriptorInterface
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\FieldMapper;

/**
 * Class FieldMapperDescriptorInterface
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface FieldMapperDescriptorInterface
{
    /**
     * Returns the value.
     * @param object $object
     * @return mixed
     */
    public function getValue($object);
}