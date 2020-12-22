<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\IngredientType;
use App\Form\IngredientTypeType;
use App\Repository\IngredientTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredient-type")
 */
class IngredientTypeController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_type_index", methods={"GET"})
     */
    public function index(IngredientTypeRepository $ingredientTypeRepository): Response
    {
        return $this->render('ingredient_type/index.html.twig', [
            'ingredient_types' => $ingredientTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredientType = new IngredientType();
        $form = $this->createForm(IngredientTypeType::class, $ingredientType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredientType);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_type_index');
        }

        return $this->render('ingredient_type/new.html.twig', [
            'ingredient_type' => $ingredientType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_type_show", methods={"GET"})
     */
    public function show(IngredientType $ingredientType): Response
    {
        return $this->render('ingredient_type/show.html.twig', [
            'ingredient_type' => $ingredientType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IngredientType $ingredientType): Response
    {
        $form = $this->createForm(IngredientTypeType::class, $ingredientType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_type_index');
        }

        return $this->render('ingredient_type/edit.html.twig', [
            'ingredient_type' => $ingredientType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IngredientType $ingredientType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredientType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredientType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_type_index');
    }
}
