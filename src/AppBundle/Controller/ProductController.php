<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Cqrs\Query\SingleProductQuery;

class ProductController extends Controller
{
    /**
     * @Route("/", name="productList")
     */
    public function indexAction(Request $request) : Response
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

        return $this->render('product/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * @Route("/product-detail/{id}", requirements={"id" = "\d+"}, name="productDetail")
     */
    public function productDetail(int $id) : Response
    {
        $product = $this->get('app.query_dispatcher')->execute(new SingleProductQuery($id));

        return $this->render('product/productDetail.html.twig', [
            'product' => $product
        ]);
    }
}
