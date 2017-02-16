<?php
/**
 * Class ModelManagerInterface
 * @package AdminProject\AdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Model;

/**
 * Class ModelManagerInterface
 * @package AdminProject\AdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
interface ModelManagerInterface
{
    public function create($object);
    public function update($object);
    public function delete($object);
    public function findBy($class, array $criteria);
    public function findOneBy($class, array $criteria);
    public function find($class, $id);


    public function getMetadata($class);


    /**
     * @param string $class
     * @param string $alias
     *
     * @return mixed
     */
    public function createQuery($class, $alias = 'o');
}