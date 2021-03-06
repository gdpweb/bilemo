<?php

/*
 * This file is part of the Symfony package.
 * (c) Stéphane BRIERE <stephanebriere@gdpweb.fr>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"index"}},
 *              "swagger_context"={"summary"="Consulter la liste des utilisateurs inscrits"}
 *          },
 *          "post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"add"}},
 *              "swagger_context"={"summary"="Ajouter un nouvel utilisateur"}
 *          },
 *     },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"show"}},
 *              "swagger_context"={"summary"="Consulter le détail d'un utilisateur inscrit"}
 *          },
 *          "delete"={
 *              "method"="DELETE",
 *              "swagger_context"={"summary"="Supprimer un utilisateur"}
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cette adresse mail est déjà utilisée par un autre compte")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"index", "show"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2,minMessage="Le nom doit contenir au moins 2 caractères")
     * @Assert\NotBlank
     * @Groups({"index", "show","add"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2,minMessage="Le prénom doit contenir au moins 2 caractères")
     * @Assert\NotBlank
     * @Groups({"index", "show","add"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     * @Assert\NotBlank
     * @Groups({"show","add"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"show","add"})
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="users")
     * @Groups({"show"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
