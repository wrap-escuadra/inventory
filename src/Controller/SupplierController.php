<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/supplier")
 */
class SupplierController extends Controller
{
    /**
     * @Route("/", name="supplier_index", methods="GET")
     */
    public function index(SupplierRepository $supplierRepository): Response
    {
        return $this->render('supplier/index.html.twig', ['suppliers' => $supplierRepository->findAll()]);
    }

    /**
     * @Route("/new", name="supplier_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $supplier = new Supplier();
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supplier);
            $em->flush();

            return $this->redirectToRoute('supplier_index');
        }

        return $this->render('supplier/new.html.twig', [
            'supplier' => $supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supplier_show", methods="GET")
     */
    public function show(Supplier $supplier): Response
    {
        return $this->render('supplier/show.html.twig', ['supplier' => $supplier]);
    }

    /**
     * @Route("/{id}/edit", name="supplier_edit", methods="GET|POST")
     */
    public function edit(Request $request, Supplier $supplier): Response
    {
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('supplier_edit', ['id' => $supplier->getId()]);
        }

        return $this->render('supplier/edit.html.twig', [
            'supplier' => $supplier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="supplier_delete", methods="DELETE")
     */
    public function delete(Request $request, Supplier $supplier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplier->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supplier);
            $em->flush();
        }

        return $this->redirectToRoute('supplier_index');
    }
}
