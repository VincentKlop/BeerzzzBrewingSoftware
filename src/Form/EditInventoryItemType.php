<?php

namespace App\Form;

use App\Entity\IngredientType;
use App\Entity\InventoryItem;
use App\Entity\InventoryItemFieldValue;
use App\Entity\Location;
use App\Entity\UnitOfMeasure;
use App\Entity\User;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditInventoryItemType extends AbstractType
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var IngredientType */
    private $defaultIngredientType;

    /** @var LocationRepository */
    private $locationRepository;

    public function __construct(EntityManagerInterface $entityManager, LocationRepository $locationRepository)
    {
        $this->entityManager = $entityManager;
        $this->defaultIngredientType = $this->entityManager->getRepository(IngredientType::class)->find(['id' => 1]);
        $this->locationRepository = $locationRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'location',
            EntityType::class,
            [
                'class' => Location::class,
                'query_builder' => $this->locationRepository->getLocationsForUserQueryBuilder($options['user']),
                'required' => true,
                'multiple' => false,
            ]
        );

        $builder->add(
            'ingredientType',
            EntityType::class,
            [
                'class' => IngredientType::class,
                'data' => $this->defaultIngredientType
            ]
        );
        $builder->add('description');
        $builder->add('count');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    protected function addElements(FormInterface $form, ?InventoryItem $inventoryItem, IngredientType $ingredientType = null)
    {
        if ($ingredientType === null) {
            $ingredientType = $this->defaultIngredientType;
        }

        $unitOfMeasureRepository = $this->entityManager->getRepository(UnitOfMeasure::class);
        $queryBuilder = $unitOfMeasureRepository->findUnitOfMeasureBelongingToIngredientTypeQueryBuilder($ingredientType);

        $form->add(
            'unitOfMeasure',
            EntityType::class,
            [
                'class' => UnitOfMeasure::class,
                'mapped' => false,
                'query_builder' => $queryBuilder,
                'data' => $unitOfMeasureRepository->findDefaultUnitOfMeasureBelongingToIngredientType($ingredientType),
                'disabled' => !is_null($inventoryItem) && !$inventoryItem->isNew()
            ]
        );

        $form->add(
            'inventoryItemFieldValues',
            CollectionType::class,
            [
                'entry_type' => InventoryItemFieldValueType::class,
                'allow_add' => false,
                'allow_delete' => false,
                'label' => 'Extra field(s)',
                'entry_options' => [
                    'label' => false
                ]
            ]
        );
    }

    function onPreSetData(FormEvent $event) {
        /** @var InventoryItem $inventoryItem */
        $inventoryItem = $event->getData();
        $form = $event->getForm();

        $ingredientType = $inventoryItem->getIngredientType();

        $this->addElements($form, $inventoryItem, $ingredientType);
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        /** @var IngredientType $ingredientType */
        $ingredientType = $this->entityManager->getRepository(IngredientType::class)->find($data['ingredientType']);

        $this->addElements($form, null, $ingredientType);

        $unitOfMeasureRepository = $this->entityManager->getRepository(UnitOfMeasure::class);
        $unitOfMeasure = $unitOfMeasureRepository->findDefaultUnitOfMeasureBelongingToIngredientType($ingredientType);
        if(isset($data['unitOfMeasure'])) {
            $unitOfMeasure = $this->entityManager->getRepository(UnitOfMeasure::class)->find($data['unitOfMeasure']);
        }

        // normalize data to default unit of measure

        $data['count'] = $data['count'] * $unitOfMeasure->getFactor();
        $event->setData($data);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user');
        $resolver->setAllowedTypes('user', array(User::class, 'int'));
        $resolver->setDefaults(
            [
                'method' => 'GET',
                'data_class' => InventoryItem::class,
            ]
        );

    }
}
