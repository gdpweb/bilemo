<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"index"}},
 *              "swagger_context"={"summary"="Consulter la liste des produits BileMo"}
 *          }
 *     },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"show"}},
 *              "swagger_context"={"summary"="Consulter le détail d'un produit BileMo"}
 *          }
 *     }
 * )
 * @ApiFilter(OrderFilter::class, properties={"name": "ASC", "price": "DESC"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "price": "exact", "name": "partial"})
 * @UniqueEntity(fields={"name"}, message="Ce téléphone existe déjà dans la base!")
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 */
class Phone
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
     * @Groups({"index", "show"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"show"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"index", "show"})
     */
    private $price;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
