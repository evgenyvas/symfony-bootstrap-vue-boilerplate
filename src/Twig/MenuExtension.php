<?php

namespace App\Twig;

use App\Service\Menu;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('menu', [$this, 'getMenu']),
        ];
    }

    public function getMenu($menu_position, $menu_type): array
    {
        return $this->menu->buildMenu($menu_position, $menu_type);
    }
}
