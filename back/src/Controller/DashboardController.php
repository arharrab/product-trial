<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ProductRepository $productRepo, CategoryRepository $categoryRepo): Response
    {
        $latestProducts = $productRepo->findBy([], ['createdAt' => 'DESC'], 5);
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'totalProducts' => $productRepo->count([]),
            'totalCategories' => $categoryRepo->count([]),
            'latestProducts' => $latestProducts,
        ]);
    }
}
