<?php

namespace App\Factory;

use App\Entity\AddressHash;
use App\Entity\AddressInt;
use App\Entity\AddressUuid;
use Faker\Generator;

class AddressFactory
{
    public static function build(Generator $faker): array
    {
        $country = $faker->country();
        $city = $faker->city();
        $street  = $faker->streetAddress();
        $number = (string) random_int(1, 10000);
        $postCode = $faker->postcode();
        $voivodeships = $faker->text(250);

        return [
            'uuid' => new AddressUuid($country, $city, $street, $number, $postCode, $voivodeships),
            'hash' => new AddressHash($country, $city, $street, $number, $postCode, $voivodeships),
            'int' => new AddressInt($country, $city, $street, $number, $postCode, $voivodeships),
        ];
    }
}