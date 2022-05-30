<?php

namespace App\CommandHandler;

use App\Command\CreatePostCommand;
use App\Command\SendNewsletterCommand;
use App\Entity\Post;
use App\Repository\NewsletterUserRepository;
use App\Repository\PostRepository;
use App\Util\ChainHandlerAbstract;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

#[AsMessageHandler]
final class CreatePostCommandHandler
{
    public function __construct(
        private readonly PostRepository $postRepository,
        private readonly NewsletterUserRepository $newsletterUserRepository,
        private readonly NotifierInterface $notifier,
    ) {
    }


    public function __invoke(CreatePostCommand $command)
    {
        $post = new Post($command->getUuid(), $command->getTitle());

        $this->postRepository->add($post);

        $this->sendNewsletter($post);
    }

    private function sendNewsletter(Post $post): void
    {
        foreach ($this->newsletterUserRepository->findAll() as $user) {
            $notification = (
            new Notification(
                'New Post on blog lukaszstaniszewski.pl!',
                ['email'],
            )
            )->content($post->getTitle());

            $recipient = new Recipient($user->getEmail());

            $this->notifier->send($notification, $recipient);
        }
    }
}
