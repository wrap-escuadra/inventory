<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SupplierStatus;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Supplier;



/**
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product_index", methods="GET")
     */
    public function index(ProductRepository $productRepository): Response
    {
//        $em = $this->getDoctrine();
//        $products = $em-
//        dd($products);

        return $this->render('product/index.html.twig', ['products' => $productRepository->findAll()]);
    }

    /**
     * @Route("/new", name="product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $product = new Product();
        $choices = $this->suppliers();
        $supplier_status = $this->suppliers_status();
        $options = [
            'suppliers' => [
                'choices' => $choices
            ],
            'suppstatus' => [
                'choices' => $supplier_status
            ]
        ];

        $form = $this->createForm(ProductType::class, $product,$options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/{id}", name="product_show", methods="GET")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods="GET|POST")
     */
    public function edit(Request $request, Product $product): Response
    {
        $choices = $this->suppliers();
        $supplier_status = $this->suppliers_status();
        $options = [
            'suppliers' => [
                'choices' => $choices
            ],
            'suppstatus' => [
                'choices' => $supplier_status
            ]
        ];

        $form = $this->createForm(ProductType::class, $product , $options);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', ['id' => $product->getId()]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods="DELETE")
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    public function suppliers(){
//        $data  = array(
//            'choices' => [
//                'One' => '1',
//                'Two' => '2'
//            ]
//        );
        $data['-select one-'] = '';
        $em = $this->getDoctrine()->getManager();
        $suppliers = $em->getRepository(Supplier::class)->findAll();


        foreach($suppliers as $supp){
            $data[$supp->name] = $supp->id;
        }

        return $data;


    }

    /**
     * @Route("/testing")
     */
    public function suppliers_status(){

        $data['-select one-'] = '';
        $em = $this->getDoctrine()->getManager();
        $suppliers = $em->getRepository(SupplierStatus::class)->findAll();

//dd($suppliers);
        foreach($suppliers as $supp){
            $data[$supp->status_desc] = $supp->id;
        }

//        return $this->json($data);
        return $data;


    }
}
