<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\SupplierStatus;

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
        $suppliers = $supplierRepository->findAll();
        return $this->render('supplier/index.html.twig', ['suppliers' => $suppliers]);
    }

    /**
     * @Route("/new", name="supplier_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $supplier = new Supplier();
        $supplierStatus = $this->choiceSupplierStatus();
        $form = $this->createForm(SupplierType::class, $supplier, ['custom' => ['choices' => $supplierStatus]]);
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

    public function choiceSupplierStatus(){
        $data['-select one-'] = '';
        $em = $this->getDoctrine()->getManager();
        $suppliers = $em->getRepository(SupplierStatus::class)->findAll();

        foreach($suppliers as $supp){
            $data[$supp->status_desc] = $supp->id;
        }

        return $data;
    }
}
