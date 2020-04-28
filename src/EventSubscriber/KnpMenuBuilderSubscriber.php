<?php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{

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
            'label' => 'Recipes',
            'childOptions' => $event->getChildOptions(),
        ])->setLabelAttribute('icon', 'fas fa-clipboard-list');

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
        ])->setLabelAttribute('icon', 'fas fa-ruler-horizontal');

        $menu->getChild('configuration')->addChild('Unit of Measurement Types', [
            'route' => 'unit_of_measure_type_index',
            'label' => 'Unit of Measurement Types',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-ruler-vertical');

        $menu->getChild('configuration')->addChild('Ingredient Types', [
            'route' => 'ingredient_type_index',
            'label' => 'Ingredient Types',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tint');

        $menu->getChild('configuration')->addChild('Ingredient Type Fields', [
            'route' => 'ingredient_type_field_index',
            'label' => 'Ingredient Type Field',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tint-slash');
    }
}
