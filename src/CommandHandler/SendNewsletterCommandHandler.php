<?php

declare(strict_types=1);

namespace App\CommandHandler;

use App\Command\SendNewsletterCommand;
use App\Repository\NewsletterUserRepository;
use App\Repository\PostRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

#[AsMessageHandler]
final class SendNewsletterCommandHandler
{
    public function __construct(
        private readonly NewsletterUserRepository $newsletterUserRepository,
        private readonly PostRepository $postRepository,
        private readonly NotifierInterface $notifier,
    ) {
    }

    public function __invoke(SendNewsletterCommand $command): void
    {
        $post = $this->postRepository->getByUuid($command->getPostUuid());

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
