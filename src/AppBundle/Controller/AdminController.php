<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use AppBundle\Cqrs\Command\CreateNewProduct;

class AdminController extends Controller
{
    /**
     * @Route("/admin/new-product", name="newProduct")
     */
    public function newProductAction(Request $request) : Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.command_bus')->handle(new CreateNewProduct(
                $form->getData()->getName(),
                $form->getData()->getPrice(),
                $form->getData()->getDescription()
            ));

            return $this->redirectToRoute('productList');
        }

        return $this->render('admin/newProduct.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
