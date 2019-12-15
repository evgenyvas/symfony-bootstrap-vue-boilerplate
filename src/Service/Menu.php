<?php

namespace App\Service;

use App\Menu\ToolbarMainMenuBuilder;
use App\Menu\SidebarMainMenuBuilder;

class Menu
{
    private $toolbarMainMenuBuilder;

    public function __construct(
        ToolbarMainMenuBuilder $toolbarMainMenuBuilder
    ) {
        $this->toolbarMainMenuBuilder = $toolbarMainMenuBuilder;
    }

    public function buildMenu($menu_position, $menu_type): array
    {
        $menu = $this->{$menu_position.ucfirst($menu_type).'MenuBuilder'}->createMenu()->getChildren();

        $menuData = [];

        foreach ($menu as $nav) {
            $itemsData = [];
            foreach ($nav->getChildren() as $child) {
                $submenu = [];

                if ($child->hasChildren()) {
                    foreach ($child->getChildren() as $submenuChild) {
                        $submenu[] = [
                            'name' => $submenuChild->getExtra('name') ?: $submenuChild->getLabel(),
                            'icon' => $submenuChild->getExtra('icon'),
                            'link' => $submenuChild->getUri(),
                            'active' => $submenuChild->getExtra('active'),
                        ];
                    }
                } else {
                    $submenu = $child->getExtra('submenu');
                }

                $itemsData[] = [
                    'name' => $child->getExtra('name') ?: $child->getLabel(),
                    'singular_name' => $child->getExtra('singular_name'),
                    'slug' => $child->getExtra('slug'),
                    'singular_slug' => $child->getExtra('singular_slug'),
                    'icon' => $child->getExtra('icon'),
                    'link' => $child->getUri(),
                    'link_new' => $child->getExtra('link_new'),
                    'title_new' => $child->getExtra('title_new'),
                    'singleton' => $child->getExtra('singleton'),
                    'type' => $child->getExtra('type'),
                    'active' => $child->getExtra('active'),
                    'item_class' => $child->getExtra('item_class'),
                    'submenu' => $submenu,
                ];
            }
            $menuData[] = [
                'nav_class' => $nav->getExtra('item_class'),
                'submenu'=>$itemsData,
            ];
        }

        return $menuData;
    }
}
