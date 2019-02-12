<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhoneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 21; $i++) {
            $phone = new Phone();
            $phone->setName('Phone '.$i);
            $phone->setDescription('Description of phone'.$i);
            $phone->setPrice(mt_rand(100, 1000));
            $manager->persist($phone);
        }
        $manager->flush();
    }
}
