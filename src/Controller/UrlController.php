<?php

declare(strict_types=1);

namespace App\Controller;

use App\Util\DateTimeResponseTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    use DateTimeResponseTrait;

    #[Route('/url')]
    #[Cache(maxage: 120, public: true, mustRevalidate: false)]
    public function index(Request $request): Response
    {
        return new Response(
            sprintf(
                '%s </br> %s',
                $request->getUri(),
                $this->generateDateTime(),
            )
        );
    }
}
