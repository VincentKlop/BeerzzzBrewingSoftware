<?php

namespace App\Controller;

use App\Entity\UnitOfMeasureType;
use App\Form\UnitOfMeasureTypeType;
use App\Repository\UnitOfMeasureTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unit-of-measure-type")
 */
class UnitOfMeasureTypeController extends AbstractController
{
    /**
     * @Route("/", name="unit_of_measure_type_index", methods={"GET"})
     */
    public function index(UnitOfMeasureTypeRepository $unitOfMeasureTypeRepository): Response
    {
        return $this->render('unit_of_measure_type/index.html.twig', [
            'unit_of_measure_types' => $unitOfMeasureTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="unit_of_measure_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $unitOfMeasureType = new UnitOfMeasureType();
        $form = $this->createForm(UnitOfMeasureTypeType::class, $unitOfMeasureType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unitOfMeasureType);
            $entityManager->flush();

            return $this->redirectToRoute('unit_of_measure_type_index');
        }

        return $this->render('unit_of_measure_type/new.html.twig', [
            'unit_of_measure_type' => $unitOfMeasureType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_of_measure_type_show", methods={"GET"})
     */
    public function show(UnitOfMeasureType $unitOfMeasureType): Response
    {
        return $this->render('unit_of_measure_type/show.html.twig', [
            'unit_of_measure_type' => $unitOfMeasureType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="unit_of_measure_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UnitOfMeasureType $unitOfMeasureType): Response
    {
        $form = $this->createForm(UnitOfMeasureTypeType::class, $unitOfMeasureType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unit_of_measure_type_index');
        }

        return $this->render('unit_of_measure_type/edit.html.twig', [
            'unit_of_measure_type' => $unitOfMeasureType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unit_of_measure_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UnitOfMeasureType $unitOfMeasureType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unitOfMeasureType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unitOfMeasureType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unit_of_measure_type_index');
    }
}
