<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;


class TestController extends Controller
{
    /**
     * @Route("/", name="test")
     */
    public function index(Request $request)
    {
        return $this->redirectToRoute('product_index');
        $em = $this->getDoctrine()->getRepository(Product::class);
        $products = $em->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('test/index.html.twig', [
           'products' => $pagination,
        ]);
    }
}
