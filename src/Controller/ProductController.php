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

use App\Service\FileUploader;
use App\Entity\Supplier;
use Symfony\Component\HttpFoundation\File\File;



/**
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product_index", methods="GET")
     */
    public function index( Request $request): Response
    {
//        dd($request->query->all())
        $query    = $this->getDoctrine()->getRepository(Product::class)->testfind($request);
        $per_page = $request->query->getInt('per_page',10);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $per_page/*limit per page*/
        );

        return $this->render('product/index.html.twig', [
                'products' => $pagination,
                'page' => $pagination->getCurrentPageNumber(),
                'searchBy' => $request->query->get('searchBy', []),
                'qsearch' => trim($request->query->get('qsearch','')),
                'sort'=> $request->query->get('sort','p.created_at'),
                'direction' => $request->query->get('direction','DESC'),
                'per_page' => $per_page,
                'layout' => $request->query->get('layout',1),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods="GET|POST")
     */
    public function new(Request $request, FileUploader $file): Response
    {
        $product = new Product();

        $supplier = $this->getDoctrine()->getRepository(Supplier::class)->findAll();
        $choices = ['choices' => $supplier];

        $form = $this->createForm(ProductType::class, $product ,$choices);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file->uploadDirectory('uploads/file');
            if($form['img']->getData()){
                $file_name = $file->upload($form['img']->getData());
                $product->setImg($file_name);
            }

            $em = $this->getDoctrine()->getManager();
            $computed_price = ( 1 + ($form['interest_rate']->getData() / 100)) * $form['supplier_price']->getData();
            $product->setComputedPrice($computed_price);

            $supplier = $this->getDoctrine()->getRepository(Supplier::class)->find($form['supplier_id']->getData());
            $product->setSupplier($supplier);
            $em->persist( $product) ;
            $em->flush();
            $this->addFlash('notice','Product successfully added');
            return  $this->redirectToRoute('product_edit',['id'=> $product->getId()]);
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
    public function edit(Request $request, Product $product, FileUploader $fileupload ) : Response
    {


     $old_image = $product->getImg();
        $supplier = $this->getDoctrine()->getRepository(Supplier::class)->findAll();
        $choices = ['choices' => $supplier];
//        dump($this->getParameter('upload_path').$product->getImg());
//        $img = $this->getParameter('upload_path').$product->getImg();
//        if($product->getImg()){
//            $product->setImg(
//                new File($img)
//            );
//        }



        $form = $this->createForm(ProductType::class, $product, $choices );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){


            if($form['img']->getData()){
                $this->delete_img($old_image);
                $file_name = $fileupload->upload($form['img']->getData());
                $product->setImg($file_name);
            }else{
                $product->setImg($old_image);
            }
            $computed_price = ( 1 + ($form['interest_rate']->getData() / 100)) * $form['supplier_price']->getData();
            $product->setComputedPrice($computed_price);
//            dd($computed_price);
            $em =   $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('notice' ,'Product successfully updated');
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
            // $em->remove($product);
            // $em->flush();
        }
        $this->addFlash('notice','Product successfully deleted.');
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

    private function delete_img($image_name){

        if($image_name  != '' && file_exists($this->getParameter('upload_path').$image_name))
        {
            unlink($this->getParameter('upload_path').$image_name);
        }
    }


}
