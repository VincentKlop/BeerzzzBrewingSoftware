<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\IngredientType;
use App\Entity\IngredientTypeField;
use App\Entity\Location;
use App\Entity\User;
use App\Repository\InventoryItemRepository;
use App\Repository\LocationRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventoryItemFilterType extends AbstractType
{
    /** @var LocationRepository */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository) {
        $this->locationRepository = $locationRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('location', EntityType::class, [
            'class' => Location::class,
            'required' => true,
            'query_builder' => $this->locationRepository->getLocationsForUserQueryBuilder($options['user']),
            'placeholder' => '*',
        ]);

        $builder->add('ingredientType', EntityType::class, [
            'class' => IngredientType::class,
            'required' => false,
            'placeholder' => '*',
        ]);

        $builder->add('description', TextType::class, [
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user');
        $resolver->setAllowedTypes('user', [User::class, 'int']);
        $resolver->setDefaults(
            [
                'method' => 'GET',
            ]
        );
    }

    public static function applyFilters(QueryBuilder $queryBuilder, $parameters): void
    {
        if (isset($parameters['ingredientType']) && $parameters['ingredientType'] instanceof IngredientType) {
            $ingredientType = $parameters['ingredientType'];
            InventoryItemRepository::addIngredientTypeFilter($queryBuilder, $ingredientType);
        }

        if (isset($parameters['description']) && strlen($parameters['description']) > 0) {
            $description = $parameters['description'];
            InventoryItemRepository::addDescriptionFilter($queryBuilder, $description);
        }

        if (isset($parameters['location']) && $parameters['location'] instanceof Location) {
            $location = $parameters['location'];
            InventoryItemRepository::addLocationFilter($queryBuilder, $location);
        }
    }
}
