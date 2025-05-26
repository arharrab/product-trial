<?php

namespace App\Controller\Api;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductApiController extends AbstractController
{
    #[Route('/api/products', name: 'api_products_list', methods: ['GET'])]
    public function list(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $products = $em->getRepository(Product::class)->findAll();

        $json = $serializer->serialize($products, 'json', ['groups' => 'product:read']);

        return JsonResponse::fromJsonString($json, 200);
    }

    #[Route('/api/products/{id}', name: 'api_product_show', methods: ['GET'])]
    public function show(Product $product, SerializerInterface $serializer): JsonResponse
    {
        $json = $serializer->serialize($product, 'json', ['groups' => 'product:read']);


        return JsonResponse::fromJsonString($json, 200);
    }
}
