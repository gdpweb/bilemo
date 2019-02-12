<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */

    public function essai(ClientRepository $clientRepository)
    {

        $clients = $clientRepository->findAll();
        var_dump($clients[1]->getUsers()->first());
        return $this->render('api/index.html.twig');

    }
}
