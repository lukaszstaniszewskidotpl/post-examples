<?php

namespace App\CommandHandler;

use App\Command\CreatePostCommand;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreatePostCommandHandler implements MessageHandlerInterface
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function __invoke(CreatePostCommand $message)
    {
        $post = new Post($message->getTitle());
        $this->postRepository->add($post);
    }
}
