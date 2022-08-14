<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\MercureDTO;
use App\Form\MercureFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mercure')]
class MercureController extends AbstractController
{
    #[Route('/publish', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(MercureFormType::class);
        $form->handleRequest($request);

        return $this->render('mercure.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/publish', methods: ['POST'])]
    public function publish(Request $request, HubInterface $hub): Response
    {
        $form = $this->createForm(MercureFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var MercureDTO $dto */
            $dto = $form->getData();

            $update = new Update(
                'http://127.0.0.1:8000/product/' . $dto->productId,
                json_encode(['status' => $dto->status->value], JSON_THROW_ON_ERROR)
            );

            $hub->publish($update);
        }

        return $this->forward(sprintf('%s::index', self::class), [
            'request' => $request,
        ]);
    }
}
