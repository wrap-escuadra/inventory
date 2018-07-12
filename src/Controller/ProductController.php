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
        $product = $productRepository->findAll();
        return $this->render('product/index.html.twig', ['products' => $product]);
    }

    /**
     * @Route("/new", name="product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $computed_price = ( 1 + ($form['interest_rate']->getData() / 100)) * $form['supplier_price']->getData();
            $product->setComputedPrice($computed_price);


          $em->persist(  $product->setSupplierId($request->request->get("product")['supplier_id']));

          $em->persist($product);

          $em->flush();

//            return $this->redirectToRoute('product_index');
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

//        dd($product);
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods="GET|POST")
     */
    public function edit(Request $request, Product $product): Response
    {


        $form = $this->createForm(ProductType::class, $product );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//dump($product);
            $computed_price = ( 1 + ($form['interest_rate']->getData() / 100)) * $form['supplier_price']->getData();
            $product->setSupplierId($form['supplier_id']->getData()->id);
            $product->setComputedPrice($computed_price);
//dd($product);
            $em =   $this->getDoctrine()->getManager();
//            dump($product->getSupplier()->name);
//            $em->persist($product);
            $em->flush();

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

//    public function suppliers(){
//        $data['-select one-'] = '';
//        $em = $this->getDoctrine()->getManager();
//        $suppliers = $em->getRepository(Supplier::class)->findAll();
//
//
//        foreach($suppliers as $supp){
//            $data[$supp->name] = $supp->id;
//        }
//
//        return $data;
//
//
//    }


}
