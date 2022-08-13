<?php

declare(strict_types=1);

namespace App\Controller;

use App\Util\DateTimeResponseTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    use DateTimeResponseTrait;

    #[Route('/')]
    #[Cache(maxage: 30, public: true, mustRevalidate: false)]
    public function index(): Response
    {
        return $this->generateResponse();
    }

    #[Route('/revalidate')]
    #[Cache(maxage: 20, public: true, mustRevalidate: true, staleWhileRevalidate: 5, staleIfError: 10)]
    public function revalidate(): Response
    {
        return $this->generateResponse();
    }

    #[Route('/without-cache')]
    public function withoutCache(): Response
    {
        return $this->generateResponse();
    }
}
