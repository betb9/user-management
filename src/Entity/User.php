<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Traits\Timestampable;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
#[UniqueEntity(
    fields: ['email'],
    message: 'Cet adresse email est déjà utilisée.',
)]
class User
{

    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Type('string', message: "Le prénom doit être une chaîne de caractère.")]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Type('string', message: "Le nom doit être une chaîne de caractère.")]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "L'adresse email est obligatoire.")]
    #[Assert\Email(message: "L'adresse email n'est pas valide.")]
    #[Assert\Type('string', message: "L'adresse email doit être une chaîne de caractère.")]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
