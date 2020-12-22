<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\InventoryItem;
use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateInventoryItemFlow extends FormFlow {

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'ingredient',
                'form_type' => NewInventoryItemType::class,
            ],
            [
                'label' => 'extra information',
                'form_type' => NewInventoryItemType::class,
                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                            if($estimatedCurrentStepNumber < 2) {
                                return false;
                            }

                            /** @var InventoryItem $inventoryItem */
                            $inventoryItem = $flow->getFormData();

                            return count($inventoryItem->getIngredientType()->getExtraFields()) === 0;
                },
            ],
        ];
    }

}
