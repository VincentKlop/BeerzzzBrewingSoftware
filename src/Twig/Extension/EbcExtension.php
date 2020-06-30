<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\InventoryItemFieldValue;
use App\Service\MaltColorService;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EbcExtension extends AbstractExtension
{
    private $maltColorService;

    public function __construct(MaltColorService $maltColorService)
    {
        $this->maltColorService = $maltColorService;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('renderExtraFields', [$this, 'renderExtraFields'], [
                'needs_environment' => true,
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function renderExtraFields(Environment $environment, $extraFields): string
    {
        $descriptions = [];
        /** @var InventoryItemFieldValue $extraField */
        foreach($extraFields as $extraField) {
            $description = sprintf('%s %s', $extraField->getValue(), $extraField->getIngredientTypeField()->getUnitOfMeasure()->getName());

            if($extraField->getIngredientTypeField()->getUnitOfMeasure()->getName() == 'EBC') {
                $colorCode = $this->maltColorService->convertEBCtoHex($extraField->getValue());

                $hexColorLabel = $environment->render('snippets/inlineColorblock.html.twig', [
                    'colorCode' => $colorCode,
                ]);
                $description = sprintf('%s %s', $hexColorLabel, $description);
            }

            $descriptions[] = $description;
        }

        return implode(', ', $descriptions);
    }
}
