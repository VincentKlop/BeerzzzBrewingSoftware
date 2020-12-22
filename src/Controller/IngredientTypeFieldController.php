<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\IngredientTypeField;
use App\Form\IngredientTypeFieldType;
use App\Repository\IngredientTypeFieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredient-type-field")
 */
class IngredientTypeFieldController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_type_field_index", methods={"GET"})
     */
    public function index(IngredientTypeFieldRepository $ingredientTypeFieldRepository): Response
    {
        return $this->render('ingredient_type_field/index.html.twig', [
            'ingredient_type_fields' => $ingredientTypeFieldRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_type_field_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredientTypeField = new IngredientTypeField();
        $form = $this->createForm(IngredientTypeFieldType::class, $ingredientTypeField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredientTypeField);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_type_field_index');
        }

        return $this->render('ingredient_type_field/new.html.twig', [
            'ingredient_type_field' => $ingredientTypeField,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_type_field_show", methods={"GET"})
     */
    public function show(IngredientTypeField $ingredientTypeField): Response
    {
        return $this->render('ingredient_type_field/show.html.twig', [
            'ingredient_type_field' => $ingredientTypeField,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_type_field_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IngredientTypeField $ingredientTypeField): Response
    {
        $form = $this->createForm(IngredientTypeFieldType::class, $ingredientTypeField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_type_field_index');
        }

        return $this->render('ingredient_type_field/edit.html.twig', [
            'ingredient_type_field' => $ingredientTypeField,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_type_field_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IngredientTypeField $ingredientTypeField): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredientTypeField->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredientTypeField);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_type_field_index');
    }
}
