<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard/product", name="app_dashboard_product", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('dashboard/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/dashboard/product/new", name="app_dashboard_product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product);
            return $this->redirectToRoute('app_dashboard_product', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/dashboard/product/{id}", name="app_dashboard_product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('dashboard/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/dashboard/product/{id}/edit", name="app_dashboard_product_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product);
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/dashboard/product/{id}", name="app_dashboard_product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product);
        }

        return $this->redirectToRoute('app_dashboard_product', [], Response::HTTP_SEE_OTHER);
    }
}
