<?php

declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticAssetController extends AbstractController
{
    #[Route('/static-asset')]
    #[Cache(maxage: 120, public: true, mustRevalidate: false)]
    public function index(): Response
    {
        return $this->render('static-asset.html.twig');
    }
}
