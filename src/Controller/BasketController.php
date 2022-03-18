<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Basket;
use App\Entity\Product;
use App\Repository\BasketRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="app_basket")
     */
    public function index(BasketRepository $basketRepository, ProductRepository $productRepository): Response
    {
        $data = $basketRepository->findBy(['user' => $this->getUser(), 'bought' => 0]);

        return $this->render('basket/index.html.twig', [
            'baskets' => $data,
        ]);
    }

    /**
     * @Route("/basket/add/{id}", name="app_basket_add_product", methods={"GET", "POST"})
     */
    public function addProduct(Product $product, BasketRepository $basketRepository): Response
    {
        if ($this->getUser()) {
            $basket = new Basket();

            $basket->setUser($this->getUser());
            $basket->setQuantity(1);
            $basket->setBought(0);
            $basket->setProduct($product);
    
            $basketRepository->add($basket);
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/basket/remove/{id}", name="app_basket_remove_product", methods={"GET", "POST"})
     * @ParamConverter("basket", options={"mapping": {"id" : "id"}})
     */
    public function removeProduct(Basket $basket, BasketRepository $basketRepository): Response
    {
        if ($this->getUser()) {
            $basket = $basketRepository->findOneBy(['id' => $basket->getId()]);

            $basketRepository->remove($basket);
        }

        return $this->redirectToRoute('app_basket', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/basket/order", name="app_basket_validate_order", methods={"GET", "POST"})
     */
    public function validateOrder(BasketRepository $basketRepository): Response
    {
        if ($this->getUser()) {
            $data = $basketRepository->findBy(['user' => $this->getUser(), 'bought' => 0]);

            foreach ($data as $value) {
                $value->setBought(1);
                $basketRepository->add($value);
            }
        }

        return $this->redirectToRoute('app_basket', [], Response::HTTP_SEE_OTHER);
    }
}
