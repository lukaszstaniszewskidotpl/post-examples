<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', methods: ['GET'])]
    public function index(int $id): Response
    {
        return $this->render('product.html.twig', [
            'id' => $id,
        ]);
    }
}
