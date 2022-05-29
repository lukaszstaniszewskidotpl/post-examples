<?php

namespace App\Controller;

use App\Command\CreatePostCommand;
use App\DTO\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/post')]
final class PostController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
    }

    #[Route('/new', name: 'post_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->dispatch(new CreatePostCommand(
                Uuid::v4(),
                $form->getData()->title,
            ));

            return $this->redirectToRoute('post_new');
        }

        return $this->renderForm('post/new.html.twig', [
            'form' => $form,
        ]);
    }
}
