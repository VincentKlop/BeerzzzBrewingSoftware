<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\BeerStyle;
use App\Form\BeerStyleType;
use App\Repository\BeerStyleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/beer/style")
 */
class BeerStyleController extends AbstractAdminController
{
    /**
     * @Route("/", name="beer_style_index", methods={"GET"})
     */
    public function index(BeerStyleRepository $beerStyleRepository): Response
    {
        $queryBuilder = $beerStyleRepository->createListQueryBuilder();

        $pagination = $this->paginate($queryBuilder);

        return $this->render('beer_style/index.html.twig', [
            'beer_styles' => $pagination,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="beer_style_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $beerStyle = new BeerStyle();
        $form = $this->createForm(BeerStyleType::class, $beerStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($beerStyle);
            $entityManager->flush();

            return $this->redirectToRoute('beer_style_index');
        }

        return $this->render('beer_style/new.html.twig', [
            'beer_style' => $beerStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="beer_style_show", methods={"GET"})
     */
    public function show(BeerStyle $beerStyle): Response
    {
        return $this->render('beer_style/show.html.twig', [
            'beer_style' => $beerStyle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="beer_style_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BeerStyle $beerStyle): Response
    {
        $form = $this->createForm(BeerStyleType::class, $beerStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('beer_style_index');
        }

        return $this->render('beer_style/edit.html.twig', [
            'beer_style' => $beerStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="beer_style_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BeerStyle $beerStyle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$beerStyle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($beerStyle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('beer_style_index');
    }
}
