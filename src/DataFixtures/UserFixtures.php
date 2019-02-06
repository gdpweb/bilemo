<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i < 20; $i++) {
            $user = new User();
            $user->setName('User ' . $i);
            $user->setFirstname('Fisrtname' . $i);
            $user->setAddress($i . 'Liverpool L5 8UT,UNITED KINGDOM');
            $user->setEmail('User' . $i . '@gdpweb.fr');
            $client = $this->getReference('client' . mt_rand(1, 4));
            $user->setClient($client);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
