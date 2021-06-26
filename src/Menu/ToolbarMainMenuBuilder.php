<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

class ToolbarMainMenuBuilder
{
    private $menuFactory;
    private $urlGenerator;
    private $tokenStorage;
    private $requestStack;
    private $translator;

    public function __construct(
        FactoryInterface $menuFactory,
        UrlGeneratorInterface $urlGenerator,
        TokenStorageInterface $tokenStorage,
        RequestStack $requestStack,
        TranslatorInterface $translator
    ) {
        $this->menuFactory = $menuFactory;
        $this->urlGenerator = $urlGenerator;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
        $this->translator = $translator;
    }

    public function createMenu(): ItemInterface
    {
        $request = $this->requestStack->getCurrentRequest();
        $curRoute = $request->get('_route');

        $menu = $this->menuFactory->createItem('root');

        $main = $menu->addChild('main');

        $main->addChild('mainPage', [
            'uri' => $this->urlGenerator->generate('index'),
            'extras' => [
                'name' => 'Main',
                'active' => $curRoute === 'index',
            ],
        ]);

        $right = $menu->addChild('right', [
            'extras' => [
                'item_class' => 'ml-auto',
            ]
        ]);
        $user = $this->tokenStorage->getToken()->getUser();
        $userMenu = $right->addChild('user', ['extras' => [
            'name' => $user->getName(),
            'icon' => 'fas fa-user',
        ]]);

        $userMenu->addChild('profile_theme', [
            'uri' => $this->urlGenerator->generate('profile_theme'),
            'extras' => [
                'name' => 'Themes',
                'icon' => 'fas fa-palette fa-fw',
            ],
        ]);

        $userMenu->addChild('logout', [
            'uri' => $this->urlGenerator->generate('app_logout'),
            'extras' => [
                'name' => $this->translator->trans('Logout', [], 'security'),
                'icon' => 'fas fa-sign-out-alt fa-fw',
            ],
        ]);

        return $menu;
    }
}
