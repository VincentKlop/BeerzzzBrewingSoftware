<?php declare(strict_types=1);

namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KnpMenuEvent::class => ['onSetupMenu', 100],
        ];
    }

    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('MainNavigationMenuItem', [
            'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');

        $menu->addChild('inventory', [
            'route' => 'inventory_item_index',
            'label' => 'Inventory',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-warehouse');

        $menu->addChild('recipes', [
            'route' => 'recipe_index',
            'label' => 'Recipes',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-clipboard-list')
            ->setExtra('routes',
                [
                    ['route' => 'recipe_new'],
                    ['route' => 'recipe_index'],
                    ['route' => 'recipe_edit'],
                    ['route' => 'recipe_add'],
                    ['route' => 'recipe_show']
                ]
            );

        $menu->addChild('Brew-day', [
            'label' => 'Brew day',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-screwdriver');

        $menu->addChild('Brews', [
            'label' => 'Brews',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-beer');

        $menu->addChild('MainConfigurationItem', [
            'label' => 'ADMIN',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');

        $menu->addChild('configuration', [
            'label' => 'Configuration',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-cogs');

        $menu->getChild('configuration')->addChild('Unit of Measurement', [
            'route' => 'unit_of_measure_index',
            'label' => 'Unit of Measurement',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-ruler-horizontal')
        ->setExtra('routes',
            [
                ['route' => 'unit_of_measure_new'],
                ['route' => 'unit_of_measure_index'],
                ['route' => 'unit_of_measure_edit'],
                ['route' => 'unit_of_measure_add'],
                ['route' => 'unit_of_measure_show']
            ]
        );

        $menu->getChild('configuration')->addChild('Unit of Measurement Types', [
            'route' => 'unit_of_measure_type_index',
            'label' => 'Unit of Measurement Types',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-ruler-vertical')
        ->setExtra('routes',
            [
                ['route' => 'unit_of_measure_type_new'],
                ['route' => 'unit_of_measure_type_index'],
                ['route' => 'unit_of_measure_type_edit'],
                ['route' => 'unit_of_measure_type_add'],
                ['route' => 'unit_of_measure_type_show']
            ]
        );

        $menu->getChild('configuration')->addChild('Ingredient Types', [
            'route' => 'ingredient_type_index',
            'label' => 'Ingredient Types',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tint')
        ->setExtra('routes',
            [
                ['route' => 'ingredient_type_new'],
                ['route' => 'ingredient_type_index'],
                ['route' => 'ingredient_type_edit'],
                ['route' => 'ingredient_type_add'],
                ['route' => 'ingredient_type_show']
            ]
        );

        $menu->getChild('configuration')->addChild('Ingredient Type Fields', [
            'route' => 'ingredient_type_field_index',
            'label' => 'Ingredient Type Field',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tint-slash')
        ->setExtra('routes',
            [
                ['route' => 'ingredient_type_field_new'],
                ['route' => 'ingredient_type_field_index'],
                ['route' => 'ingredient_type_field_edit'],
                ['route' => 'ingredient_type_field_add'],
                ['route' => 'ingredient_type_field_show']
            ]
        );

        $menu->getChild('configuration')->addChild('Beer Styles', [
            'route' => 'beer_style_index',
            'label' => 'Beer Styles',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-mortar-pestle')
            ->setExtra('routes',
                [
                    ['route' => 'beer_style_new'],
                    ['route' => 'beer_style_index'],
                    ['route' => 'beer_style_edit'],
                    ['route' => 'beer_style_add'],
                    ['route' => 'beer_style_show']
                ]
            );

        $menu->getChild('configuration')->addChild('Brewery', [
            'route' => 'brewery_index',
            'label' => 'Brewery',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-globe-europe')
            ->setExtra('routes',
                [
                    ['route' => 'brewery_new'],
                    ['route' => 'brewery_index'],
                    ['route' => 'brewery_edit'],
                    ['route' => 'brewery_add'],
                    ['route' => 'brewery_show']
                ]
            );

        $menu->getChild('configuration')->addChild('Locations', [
            'route' => 'location_index',
            'label' => 'Locations',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-location-arrow')
            ->setExtra('routes',
                [
                    ['route' => 'loction_new'],
                    ['route' => 'location_index'],
                    ['route' => 'location_edit'],
                    ['route' => 'location_add'],
                    ['route' => 'location_show']
                ]
            );

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $menu->getChild('configuration')->addChild('Users', [
                'route' => 'user_index',
                'label' => 'Users',
                'childOptions' => $event->getChildOptions()
            ])->setLabelAttribute('icon', 'fas fa-user')
            ->setExtra('routes',
                [
                    ['route' => 'user_new'],
                    ['route' => 'user_index'],
                    ['route' => 'user_edit'],
                    ['route' => 'user_add'],
                    ['route' => 'user_show']
                ]
            );
        }

    }
}
