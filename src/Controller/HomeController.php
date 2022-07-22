<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render(
            'home/home.html.twig',
            [
                'dateTimes' => [
                    'now',
                    '+1 hour',
                    '+1 day',
                    '+1 week',
                    '+1 year',
                ]
            ]
        );
    }

    #[Route('/static')]
    public function static(): Response
    {
        return $this->render(
            'home/static.html.twig', []
        );
    }
}
