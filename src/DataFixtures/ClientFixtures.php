<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $client = new Client();
        $client->setUsername('admin');
        $password = $this->encoder->encodePassword($client, 'bilemo');
        $client->setPassword($password);
        $client->setEmail('admin@gdpweb.fr');
        $client->setRoles(['ROLE_USER,ROLE_ADMIN']);
        $manager->persist($client);

        for ($i = 1; $i < 5; $i++) {
            $client = new Client();
            $client->setUsername('client' . $i);
            $password = $this->encoder->encodePassword($client, 'bilemo');
            $client->setPassword($password);
            $client->setEmail('client' . $i . '@gdpweb.fr');
            $client->setRoles(['ROLE_USER']);
            $this->addReference('client' . $i, $client);
            $manager->persist($client);
        }
        $manager->flush();
    }
}
