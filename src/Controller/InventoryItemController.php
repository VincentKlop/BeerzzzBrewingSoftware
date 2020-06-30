<?php

namespace App\Controller;

use App\Entity\InventoryItem;
use App\Form\EditInventoryItemType;
use App\Form\InventoryItemFilterType;
use App\Repository\InventoryItemRepository;
use App\Form\CreateInventoryItemFlow;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventory-item")
 */
class InventoryItemController extends AbstractAdminController
{
    /**
     * @var CreateInventoryItemFlow
     */
    private $createInventoryItemFlow;

    public function __construct(
        CreateInventoryItemFlow $createInventoryItemFlow
    ) {
        $this->createInventoryItemFlow = $createInventoryItemFlow;
    }

    /**
     * @Route("/", name="inventory_item_index", methods={"GET"})
     */
    public function index(Request $request, InventoryItemRepository $inventoryItemRepository): Response
    {
        $queryBuilder = $inventoryItemRepository->createListQueryBuilder();

        $filterForm = $this->createForm(InventoryItemFilterType::class, null, ['user' => $this->getUser()]);

        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            InventoryItemFilterType::applyFilters($queryBuilder, $filterForm->getData());
        }

        $pagination = $this->paginate($queryBuilder);

        return $this->render('inventory_item/index.html.twig', [
            'inventory_items' => $pagination,
            'pagination' => $pagination,
            'filterForm' => $filterForm->createView(),
        ]);
    }

    /**
     * @Route("/new", name="inventory_item_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inventoryItem = new InventoryItem();
        $flow = $this->createInventoryItemFlow;
        $flow->setGenericFormOptions(['user' => $this->getUser()]);
        $flow->bind($inventoryItem);

        $form = $flow->createForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                $entityManager = $this->getDoctrine()->getManager();

                /** @var EntityManager $entityManager */
                $entityManager->persist($inventoryItem);
                $entityManager->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirectToRoute('inventory_item_index');
            }

        }

        return $this->render('inventory_item/new.html.twig', [
            'inventory_item' => $inventoryItem,
            'form' => $form->createView(),
            'flow' => $flow,
        ]);
    }

    /**
     * @Route("/{id}", name="inventory_item_show", methods={"GET"})
     */
    public function show(InventoryItem $inventoryItem): Response
    {
        return $this->render('inventory_item/show.html.twig', [
            'inventory_item' => $inventoryItem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inventory_item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InventoryItem $inventoryItem): Response
    {
        $form = $this->createForm(EditInventoryItemType::class, $inventoryItem, ['user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventory_item_index');
        }

        return $this->render('inventory_item/edit.html.twig', [
            'inventory_item' => $inventoryItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inventory_item_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InventoryItem $inventoryItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inventoryItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inventoryItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inventory_item_index');
    }
}
