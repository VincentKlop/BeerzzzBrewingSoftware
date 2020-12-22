<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\RecipeMashRows;
use App\Entity\UnitOfMeasure;
use App\Entity\UnitOfMeasureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MashRowType extends AbstractType
{
    private EntityManagerInterface  $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $unitOfMeasureRepository = $this->entityManager->getRepository(UnitOfMeasure::class);
        $unitOfMeasureTypeRepository = $this->entityManager->getRepository(UnitOfMeasureType::class);

        $builder->add(
            'temperature',
            IntegerType::class
        );

        $builder->add(
            'unitOfMeasureTemprature',
            EntityType::class,
            [
                'class' => UnitOfMeasure::class,
                //'mapped' => false,
                'query_builder' => $unitOfMeasureRepository->findUnitOfMeasureByTypeQueryBuilder(
                    $unitOfMeasureTypeRepository->findOneBy(['name' => 'Heat'])
                ),
            ]
        );

        $builder->add(
            'timeInMinutes',
            TextType::class
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeMashRows::class,
        ]);
    }
}
