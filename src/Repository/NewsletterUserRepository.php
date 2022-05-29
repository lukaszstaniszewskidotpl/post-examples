<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NewsletterUser;

class NewsletterUserRepository
{
    public function findAll(): array
    {
        return [
            new NewsletterUser('kontakt@lukaszstaniszewski.pl'),
        ];
    }
}
