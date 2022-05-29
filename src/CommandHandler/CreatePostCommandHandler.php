<?php

namespace App\CommandHandler;

use App\Command\CreatePostCommand;
use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(priority: 100)]
final class CreatePostCommandHandler
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    public function __invoke(CreatePostCommand $command)
    {
        $post = new Post($command->getUuid(), $command->getTitle());

        $this->postRepository->add($post);
    }
}
