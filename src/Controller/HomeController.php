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
    #[Cache(maxage: 120, public: true, mustRevalidate: false)]
    public function index(): Response
    {
        return $this->generateResponse();
    }

    #[Route('/many/{someText}')]
    #[Cache(maxage: 120, public: true, mustRevalidate: false)]
    public function withText(string $someText): Response
    {
        return new Response(
            sprintf('%s %s', $someText, $this->generateDateTime())
        );
    }
}
