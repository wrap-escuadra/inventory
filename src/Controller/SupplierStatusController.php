<?php

namespace App\Controller;

use App\Entity\SupplierStatus;
use App\Form\SupplierStatusType;
use App\Repository\SupplierStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supplier/status")
 */
class SupplierStatusController extends Controller
{
    /**
     * @Route("/", name="supplier_status_index", methods="GET")
     */
    public function index(SupplierStatusRepository $supplierStatusRepository): Response
    {
        return $this->render('supplier_status/index.html.twig', ['supplier_statuses' => $supplierStatusRepository->findAll()]);
    }

    /**
     * @Route("/new", name="supplier_status_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $supplierStatus = new SupplierStatus();
        $form = $this->createForm(SupplierStatusType::class, $supplierStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplierStatus);
            $em->flush();

            return $this->redirectToRoute('supplier_status_index');
        }

        return $this->render('supplier_status/new.html.twig', [
            'supplier_status' => $supplierStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supplier_status_show", methods="GET")
     */
    public function show(SupplierStatus $supplierStatus): Response
    {
        return $this->render('supplier_status/show.html.twig', ['supplier_status' => $supplierStatus]);
    }

    /**
     * @Route("/{id}/edit", name="supplier_status_edit", methods="GET|POST")
     */
    public function edit(Request $request, SupplierStatus $supplierStatus): Response
    {
        $form = $this->createForm(SupplierStatusType::class, $supplierStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice' ,'Supplier successfully updated');
            return $this->redirectToRoute('supplier_status_edit', ['id' => $supplierStatus->getId()]);
        }

        return $this->render('supplier_status/edit.html.twig', [
            'supplier_status' => $supplierStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supplier_status_delete", methods="DELETE")
     */
    public function delete(Request $request, SupplierStatus $supplierStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplierStatus->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplierStatus);
            $em->flush();
        }

        return $this->redirectToRoute('supplier_status_index');
    }
}
