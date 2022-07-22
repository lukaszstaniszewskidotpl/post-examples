<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\DateTimeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(DateTimeForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_frame_index', ['dateTime' => $form->getData()->raw]);
        }

        return $this->renderForm('form/index.html.twig', ['form' => $form]);
    }
}
