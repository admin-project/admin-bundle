<?php
/**
 * Class FieldMapperBuilderInterface
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\FieldMapper;

use AdminProject\AdminBundle\Admin\AbstractAdmin;

/**
 * Class FieldMapperBuilderInterface
 * @package AdminProject\AdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface FieldMapperBuilderInterface
{
    /**
     * Creates the field mapping
     * @param AbstractAdmin $admin
     * @return FieldMapper
     */
    public function createFieldMapping(AbstractAdmin $admin);
}