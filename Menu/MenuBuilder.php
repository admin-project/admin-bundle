<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminProject\AdminBundle\Menu;

use AdminProject\AdminBundle\Admin\Pool;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;


class MenuBuilder
{
    /**
     * Saves the admin pool
     * @var Pool
     */
    private $pool;

    /**
     * Saves the factory
     * @var FactoryInterface
     */
    private $factory;

    /**
     * MenuBuilder constructor.
     * @param Pool $pool
     * @param FactoryInterface $factory
     */
    public function __construct(Pool $pool, FactoryInterface $factory)
    {
        $this->pool    = $pool;
        $this->factory = $factory;
    }

    /**
     * Builds sidebar menu.
     * @param array            $options
     * @return ItemInterface
     */
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes([
            'class' => 'sidebar-menu'
        ]);

        foreach ($this->pool->getAdminGroups() as $name => $group) {
            $extras = array(
                'icon'       => $group['icon'],
                'multilevel' => false
            );

            $label = $this->pool->getTranslator()->trans(
                isset($group['label']) ? $group['label'] : $name,
                [],
                isset($group['translation_domain']) ? $group['translation_domain'] : null
            );

            $children = $this->pool->getAdminServicesForGroup($name);

            if (count($children) > 0) {
                $item = $menu->addChild($label, ['uri' => '#']);
                $item->setAttribute('class', 'treeview');
                $item->setChildrenAttributes([
                    'class' => 'treeview-menu'
                ]);
                $extras['multilevel'] = true;

                foreach ($children as $adminService) {
                    $item->addChild(
                        $this->pool->getTranslator()->trans($adminService->getLabel(), [], $adminService->getTranslationDomain()),
                        ['route' => 'homepage']
                    );
                }
            } else {
                $item = $menu->addChild($label, ['route' => 'homepage']);
            }

            $item->setExtras($extras);
        }

        return $menu;
    }
}
