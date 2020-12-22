<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Brewery;
use App\Entity\User;
use App\Form\BreweryType;
use App\Repository\BreweryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/brewery")
 */
class BreweryController extends AbstractController
{
    /**
     * @Route("/", name="brewery_index", methods={"GET"})
     */
    public function index(BreweryRepository $breweryRepository): Response
    {
        return $this->render('brewery/index.html.twig', [
            'breweries' => $breweryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="brewery_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $brewery = new Brewery();
        $form = $this->createForm(BreweryType::class, $brewery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brewery);

            /** @var User $user */
            $user = $this->getUser();
            $user->addBrewery($brewery);
            $entityManager->persist($user);

            $entityManager->flush();

            return $this->redirectToRoute('brewery_index');
        }

        return $this->render('brewery/new.html.twig', [
            'brewery' => $brewery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brewery_show", methods={"GET"})
     */
    public function show(Brewery $brewery): Response
    {
        return $this->render('brewery/show.html.twig', [
            'brewery' => $brewery,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="brewery_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Brewery $brewery): Response
    {
        $form = $this->createForm(BreweryType::class, $brewery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brewery_index');
        }

        return $this->render('brewery/edit.html.twig', [
            'brewery' => $brewery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brewery_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Brewery $brewery): Response
    {
        if ($this->isCsrfTokenValid('delete'.$brewery->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($brewery);
            $entityManager->flush();
        }

        return $this->redirectToRoute('brewery_index');
    }
}
