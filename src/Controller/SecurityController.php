<?php

/*
 * This file is part of the Symfony package.
 * (c) Stéphane BRIERE <stephanebriere@gdpweb.fr>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $data = json_decode($request->getContent());
        $client = new Client();
        $client->setUsername($data->username);
        $client->setPassword($passwordEncoder->encodePassword($client, $data->password));
        $client->setEmail($data->email);
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        return new Response('L\'utilisateur a bien été créé');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $client = $this->getUser();

        return $this->json([
            'username' => $client->getUsername(),
            'roles' => $client->getRoles(),
        ]);
    }
}
