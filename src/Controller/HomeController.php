<?php

declare(strict_types=1);

namespace App\Controller;

use DateTime;
use DateTimeZone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    #[Cache(maxage: 60, public: true, mustRevalidate: false)]
    public function index(): Response
    {
        return $this->generateResponse();
    }

    #[Route('/revalidate')]
    #[Cache(maxage: 60, public: true, mustRevalidate: true)]
    public function revalidate(): Response
    {
        return $this->generateResponse();
    }

    #[Route('/without-cache')]
    public function withoutCache(): Response
    {
        return $this->generateResponse();
    }

    private function generateResponse(): Response
    {
        return new Response(
            (new DateTime())
                ->setTimezone(new DateTimeZone('Europe/Warsaw'))
                ->format('Y-m-d H:i:s:v')
        );
    }
}
