<?php
/**
 * Class AbstractAdmin
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\AdminBundle\Admin;

use AdminProject\AdminBundle\Datagrid\Datagrid;
use AdminProject\AdminBundle\Datagrid\DatagridBuilderInterface;
use AdminProject\AdminBundle\FieldMapper\FieldMapper;
use AdminProject\AdminBundle\FieldMapper\FieldMapperBuilderInterface;
use AdminProject\AdminBundle\Model\ModelManagerInterface;
use AdminProject\AdminBundle\Route\Builder\AdminRouteCollection;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class AbstractAdmin
 * @package AdminProject\AdminBundle\Admin
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
abstract class AbstractAdmin
{

    const CLASS_REGEX =
        '@
        (?:([A-Za-z0-9]*)\\\)?        # vendor name / app name
        (Bundle\\\)?                  # optional bundle directory
        ([A-Za-z0-9]+?)(?:Bundle)?\\\ # bundle name, with optional suffix
        (
            Entity|Document|Model|PHPCR|CouchDocument|Phpcr|
            Doctrine\\\Orm|Doctrine\\\Phpcr|Doctrine\\\MongoDB|Doctrine\\\CouchDB
        )\\\(.*)@x';

    /**
     * Defines the list mode.
     * @var int
     */
    const MODE_LIST = 'list';

    /**
     * Defines the edit mode.
     * @var int
     */
    const MODE_EDIT = 'edit';

    /**
     * Defines the show mode.
     * @var int
     */
    const MODE_SHOW = 'show';

    /**
     * Saves the code.
     * @var string
     */
    private $code;

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
     * Saves the routes.
     * @var RouteCollection
     */
    private $routes;

    /**
     * Saves the entity class.
     * @var string
     */
    private $entityClass;

    /**
     * Saves the entity class label.
     * @var string
     */
    private $entityClassLabel;

    /**
     * Saves the translation domain for this admin.
     * @var string
     */
    protected $translationDomain = 'messages';

    /**
     * Defines the default controller name.
     * @var string
     */
    protected $defaultControllerName;

    /**
     * Defines the default action.
     * @var string
     */
    protected $defaultAction;

    /**
     * Saves the model manager.
     * @var ModelManagerInterface
     */
    private $modelManager;

    /**
     * Saves the datagrid builder.
     * @var DatagridBuilderInterface
     */
    private $datagridBuilder;

    /**
     * Saves the datagrid
     * @var Datagrid
     */
    private $datagrid;

    /**
     * Saves the field mapper builder.
     * @var FieldMapperBuilderInterface
     */
    private $fieldmapperBuilder;

    /**
     * Saves the field mapper.
     * @var FieldMapper
     */
    private $fieldMapper;

    /**
     * Saves the mode.
     * @var string
     */
    private $mode;

    /**
     * AbstractAdmin constructor.
     * @param string $entityClass
     */
    public function __construct($entityClass)
    {
        $this->entityClass = $entityClass;
        $this->entityClassLabel = substr($this->entityClass, strrpos($this->entityClass, '\\') + 1);
    }

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
        if (!$this->translationDomain) {
            $this->translationDomain = $translationDomain;
        }
    }

    /**
     * Sets the code.
     * @param string $code
     * @return void
     */
    final public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Sets the default controller name.
     * @param string $defaultControllerName
     * @return void
     */
    final public function setDefaultControllerName($defaultControllerName)
    {
        $this->defaultControllerName = $defaultControllerName;
    }

    /**
     * Sets the default action.
     * @param string $defaultAction
     * @return void
     */
    final public function setDefaultAction($defaultAction)
    {
        $this->defaultAction = $defaultAction;
    }

    /**
     * Sets the model manager.
     * @param ModelManagerInterface $modelManager
     * @return void
     */
    final public function setModelManager(ModelManagerInterface $modelManager)
    {
        $this->modelManager = $modelManager;
    }

    /**
     * Sets the datagrid builder.
     * @param DatagridBuilderInterface $datagridBuilder
     * @return void
     */
    final public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder)
    {
        $this->datagridBuilder = $datagridBuilder;
    }

    /**
     * Sets the field mapper builder
     * @param FieldMapperBuilderInterface $fieldMapperBuilder
     */
    final public function setFieldmapperBuilder(FieldMapperBuilderInterface $fieldMapperBuilder)
    {
        $this->fieldmapperBuilder = $fieldMapperBuilder;
    }

    /**
     * Sets the mode.
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
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
    public function getAdminPool()
    {
        return $this->pool;
    }

    /**
     * Returns the label.
     * @return string
     */
    public function getLabel()
    {
        return ($this->label ? $this->label : $this->getEntityClassLabel());
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
     * Returns the datagrid builder.
     * @return DatagridBuilderInterface
     */
    private function getDatagridBuilder()
    {
        return $this->datagridBuilder;
    }

    /**
     * Returns the fieldmapper builder.
     * @return FieldMapperBuilderInterface
     */
    private function getFieldmapperBuilder()
    {
        return $this->fieldmapperBuilder;
    }

    /**
     * Returns the entity class.
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Returns the entity class label.
     * @return string
     */
    public function getEntityClassLabel()
    {
        return $this->entityClassLabel;
    }

    /**
     * Returns the admin code.
     * @return string
     */
    final public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the mode.
     * @return string
     */
    final public function getMode()
    {
        return $this->mode;
    }

    /**
     * Returns the routes.
     * @return AdminRouteCollection
     */
    public function getRoutes()
    {
        if (!$this->routes instanceof AdminRouteCollection) {
            $this->buildRoutes();
        }

        return $this->routes;
    }

    /**
     * Builds the routes.
     * @return void
     */
    private function buildRoutes()
    {
        $this->routes = new AdminRouteCollection(
            $this->getRouteBasePattern(),
            $this->getDefaultControllerName(),
            $this->getCode()
        );

        $pathInfoRouteBuilder = $this->pool->getContainer()->get('adminproject.router.builder.pathinfo');
        $pathInfoRouteBuilder->build($this, $this->routes);

        $this->configureRoutes($this->routes);
    }

    /**
     * Generates the url.
     * @param string $action
     * @return string
     */
    public function generateUrl($action)
    {
        return $this->pool->getContainer()->get('adminproject.router')->generateUrl($this, $action);
    }

    /**
     * Returns the default controller name.
     * @return string
     */
    public function getDefaultControllerName()
    {
        return $this->defaultControllerName;
    }

    /**
     * Returns the default action.
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }

    /**
     * Builds the name.
     * @param string $action
     * @return string
     */
    public function getRouteName($action)
    {
        return sprintf('%s_%s', $this->getCode(), $action);
    }

    /**
     * Builds the path
     * @param string $action
     * @return string
     */
    public function getRoutePath($action)
    {
        return sprintf('%s/%s', $this->getCode(), $action);
    }

    public function getRouteBasePattern()
    {
        /*
         * if ($this->baseRoutePattern) {
         *  return $this->baseRoutePattern;
         * }
         */

        if (preg_match(self::CLASS_REGEX, $this->getEntityClass(), $matches)) {
            return sprintf('/%s%s/%s',
                empty($matches[1]) ? '' : $this->urlize($matches[1], '-').'/',
                $this->urlize($matches[3], '-'),
                $this->urlize($matches[5], '-')
            );
        }


        return false;
    }

    /**
     * urlize the given word.
     * @param string $word
     * @param string $sep
     * @return string
     */
    public function urlize($word, $sep = '_')
    {
        return strtolower(preg_replace('/[^a-z0-9_]/i', $sep.'$1', $word));
    }

    /**
     * Returns the datagrid.
     * @return Datagrid
     */
    public function getDatagrid()
    {
        if (!$this->datagrid) {
            $datagrid = $this->getDatagridBuilder()->createBaseDatagrid($this);
            $this->configureDatagrid($datagrid);

            $this->datagrid = $datagrid;
        }

        return $this->datagrid;
    }

    /**
     * Returns the field mapper.
     * @return FieldMapper
     */
    public function getFieldMapper()
    {
        if (!$this->fieldMapper) {
            $fieldmapper = $this->getFieldmapperBuilder()->createFieldMapping($this);
            $this->fieldMapper = $fieldmapper;
        }

        return $this->fieldMapper;
    }

    /* -------------------- Overloadable configurations -------------------- */

    /**
     * Configures the routes.
     * @param AdminRouteCollection $collection
     * @return void
     */
    protected function configureRoutes(AdminRouteCollection $collection)
    {
    }


    protected function configureDatagrid(Datagrid $datagrid)
    {
    }

    /**
     * Creates the query.
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQuery()
    {
        return $this->modelManager->createQuery($this->getEntityClass());
    }
}