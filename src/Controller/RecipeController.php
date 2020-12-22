<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe")
 */
class RecipeController extends AbstractController
{
    /** @var RecipeRepository */
    private $recipeRepository;

    public function __construct(
        RecipeRepository $recipeRepository
    ) {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @Route("/", name="recipe_index", methods={"GET"})
     */
    public function index(RecipeRepository $recipeRepository): Response
    {
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="recipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_show", methods={"GET"})
     */
    public function show(Recipe $recipe): Response
    {
        $totalAmountOfMalts = $this->recipeRepository->findTotalMaltsForRecipe($recipe);

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'totalAmountOfMalts' => $totalAmountOfMalts['totalCount']
        ]);
    }

    /**
     * @Route("/{id}/pdf", name="recipe_pdf", methods={"GET"})
     */
    public function pdf(Recipe $recipe): PdfResponse
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Halvetica');
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);

        $totalAmountOfMalts = $this->recipeRepository->findTotalMaltsForRecipe($recipe);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('recipe/pdf.html.twig', [
            'recipe' => $recipe,
            'totalAmountOfMalts' => $totalAmountOfMalts['totalCount']
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("recipe.pdf", [
            "Attachment" => true
        ]);

        die(); // stop outputting data, otherwise invalid pdf
    }

    /**
     * @Route("/{id}/edit", name="recipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_index');
    }
}
