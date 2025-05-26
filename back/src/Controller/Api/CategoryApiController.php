<?php
// src/Controller/Api/CategoryApiController.php
namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryApiController extends AbstractController
{
    #[Route('/api/categories', name: 'api_categories_list', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): JsonResponse
    {
        $categories = $categoryRepository->findAll();

        $data = array_map(fn($category) => [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'description' => $category->getDescription(),
        ], $categories);

        return $this->json($data);
    }
}
