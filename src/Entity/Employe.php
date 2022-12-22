<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Entreprise;

/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEmbouche;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="employes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance ; 
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }


    //on es obligé de changer le format et le tybe de l'objet parce que c'est un dateTime 
    //dateTime un objet et on ne peut pas le conventir en string quand on fait echo si pour ca on change la format 

    //ou on peux faire ca en twig parce que il a des filters deja prets
    public function getDateEmbouche(): ?\DateTimeInterface
    {
        return $this->dateEmbouche ;
    }

    public function setDateEmbouche(?\DateTimeInterface $dateEmbouche): self
    {
        $this->dateEmbouche = $dateEmbouche;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getAge(){
        $now = new \DateTime() ;
        $interval= date_diff($this->dateNaissance,$now) ; 
        return $interval->format('%Y');

    }

    public function __toString()
    {
        return $this->nom ." ".$this->prenom ." ".$this->dateNaissance->format('d-m-y')  ." ".$this->dateEmbouche->format('d-m-y') ." ".$this->ville ." ".$this->entreprise  ;
    }
}
