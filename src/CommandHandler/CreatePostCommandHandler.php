<?php

namespace App\CommandHandler;

use App\Command\CreatePostCommand;
use App\Command\SendNewsletterCommand;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Util\ChainHandlerAbstract;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class CreatePostCommandHandler extends ChainHandlerAbstract
{
    public function __construct(
        MessageBusInterface $commandBus,
        private readonly PostRepository $postRepository
    ) {
        parent::__construct($commandBus);
    }


    public function __invoke(CreatePostCommand $command)
    {
        $post = new Post($command->getUuid(), $command->getTitle());

        $this->postRepository->add($post);

        $this->next(new SendNewsletterCommand($command->getUuid()));
    }
}
