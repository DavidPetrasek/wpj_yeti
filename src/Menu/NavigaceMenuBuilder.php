<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\Attribute\AsMenuBuilder;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

final class NavigaceMenuBuilder
{
    public function __construct(private FactoryInterface $factory)
    {
    }

    #[AsMenuBuilder(name: 'hlavni_navigace')]
    public function hlavniNavigace(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'flex flex-wrap items-center gap-2');

        $odkazy = [
            'Best of Yeti' => 'hlavni_stranka',
            'Přidat Yetiho' => 'pridani_yetiho',
            'Yetinder' => 'yetinder',
            'Statistika' => 'statistika_hodnoceni',
        ];

        foreach ($odkazy as $nazev => $route) {
            $menu->addChild($nazev, ['route' => $route])
                ->setLinkAttribute('class', 'rounded-full px-4 py-2 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white');
        }

        return $menu;
    }
}
