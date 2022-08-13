<?php

declare(strict_types=1);

namespace App\Controller;

use App\Util\DateTimeResponseTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    use DateTimeResponseTrait;

    #[Route('/group')]
    #[Cache(maxage: 120, public: true, mustRevalidate: false)]
    public function index(Request $request): Response
    {
        return new Response(sprintf(
            'Your group is: %s </br>%s',
            $request->cookies->get('user_group'),
            $this->generateDateTime()
        ));
    }
}
