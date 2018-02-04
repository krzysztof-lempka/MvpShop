<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/", name="productList")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $query = $repository->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        // replace this example code with whatever you need
        return $this->render('product/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * @Route("/product-detail/{id}", requirements={"id" = "\d+"}, name="productDetail")
     */
    public function productDetail(int $id)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->find($id);

        // replace this example code with whatever you need
        return $this->render('product/productDetail.html.twig', [
            'product' => $product
        ]);
    }
}
