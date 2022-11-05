<?php

namespace App\Entity;

use App\Repository\AddressUuidRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AddressUuidRepository::class)]
class AddressUuid
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    private string $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $country;

    #[ORM\Column(type: 'string', length: 255)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private string $street;

    #[ORM\Column(type: 'string', length: 8)]
    private string $number;

    #[ORM\Column(type: 'string', length: 6)]
    private string $postCode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $voivodeships;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        string $country,
        string $city,
        string $street,
        string $number,
        string $postCode,
        string $voivodeships,
    ) {
        $this->id = Uuid::v4()->toRfc4122();

        $this->createdAt = new \DateTimeImmutable();

        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;
        $this->postCode = $postCode;
        $this->voivodeships = $voivodeships;
    }
}
