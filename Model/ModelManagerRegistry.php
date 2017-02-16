<?php
/**
 * Class ModelManagerRegistry
 * @package AdminProject\AdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Model;

use AdminProject\AdminBundle\Exception\Model\ModelManagerAlreadyRegisteredException;
use AdminProject\AdminBundle\Exception\Model\ModelManagerNotFoundException;

/**
 * Class ModelManagerRegistry
 * @package AdminProject\AdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class ModelManagerRegistry
{
    /**
     * Saves the managers.
     * @var ModelManagerInterface[]
     */
    private $manager;

    /**
     * Adds the model manager.
     * @param string                $id
     * @param ModelManagerInterface $manager
     * @return void
     * @throws ModelManagerAlreadyRegisteredException
     */
    public function registerModelManager($id, ModelManagerInterface $manager)
    {
        if (isset($this->manager[$id])) {
            throw new ModelManagerAlreadyRegisteredException(sprintf('ModelManager "%s" is already registered', $id));
        }

        $this->manager[$id] = $manager;
    }

    /**
     * Returns the model managers.
     * @return ModelManagerInterface[]
     */
    public function getModelManagers()
    {
        return $this->manager;
    }

    /**
     * Returns the model manager or throws exception if not found.
     * @param string $id
     * @return ModelManagerInterface
     * @throws ModelManagerNotFoundException
     */
    public function getModelManager($id)
    {
        if (!isset($this->manager[$id])) {
            throw new ModelManagerNotFoundException(sprintf('ModelManager "%s" not found', $id));
        }

        return $this->manager[$id];
    }
}