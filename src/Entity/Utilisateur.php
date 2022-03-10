<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"username"}, message="Ce nom d'user fonctionne déjà")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=12, minMessage=" Nom d'user trop court, 5 caractères minimum", maxMessage=" Nom d'user trop long, 12 caractères maximum")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=12, minMessage=" Mot de passe trop court, 5 caractères minimum", maxMessage=" Mot de passe trop long, 12 caractères maximum")
     */
    private $password;
    
    /**
     * @Assert\Length(min=5, max=12, minMessage=" Nom d'user trop court, 5 caractères minimum", maxMessage=" Nom d'user trop long, 12 caractères maximum")
     * @Assert\EqualTo(propertyPath="password", message="Vos mdp dne match pas !")
     */
    private $verificationPassword;

    
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    public function setUsername(string $username): self
    {
        $this->username = $username;
        
        return $this;
    }
    
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    public function setPassword(string $password): self
    {
        $this->password = $password;
        
        return $this;
    }
    
    public function getVerificationPassword(): ?string
{
    return $this->verificationPassword;
}

    public function setVerificationPassword(string $verificationPassword): self
{
    $this->verificationPassword = $verificationPassword;

    return $this;
}

    public function eraseCredentials()
{
}

    public function getSalt()
{
}

    public function getRoles()
{
    return ['ROLE_USER'];
}

}
