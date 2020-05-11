<?php

namespace App\Form;

use App\Form\InventoryItemType;
use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateInventoryItemFlow extends FormFlow {

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'ingredient',
                'form_type' => InventoryItemType::class,
            ],
            [
                'label' => 'extra information',
                'form_type' => InventoryItemType::class,
//                'skip' => function($estimatedCurrentStepNumber, FormFlowInterface $flow) {
//                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveEngine();
//                },
            ],
        ];
    }

}
