<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product")
     */
    public function index(EntityManagerInterface $em)
    {
        $products = $em->getRepository(Product::class)->findBy(array(), array('price' => 'ASC'));

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }
}
