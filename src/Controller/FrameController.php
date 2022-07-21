<?php

declare(strict_types=1);

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/frame')]
class FrameController extends AbstractController
{
    #[Route('/{dateTime}')]
    public function index(string $dateTime): Response
    {
        return $this->render('frame/index.html.twig', [
            'dateTime' => new DateTime($dateTime),
        ]);
    }
}
