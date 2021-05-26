<?php

namespace App\Entity;

use App\Repository\ProfessorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfessorRepository::class)
 */
class Professor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cognom;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $usuari;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contrassenya;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $role;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alta;

    /**
     * @ORM\OneToMany(targetEntity=Alumne::class, mappedBy="professor")
     */
    private $alumnes;

    /**
     * @ORM\OneToMany(targetEntity=Accio::class, mappedBy="professor")
     */
    private $accions;

    /**
     * @ORM\OneToMany(targetEntity=Practica::class, mappedBy="professor")
     */
    private $practiques;

    public function __construct()
    {
        $this->alumnes = new ArrayCollection();
        $this->accions = new ArrayCollection();
        $this->practiques = new ArrayCollection();
    }

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

    public function getCognom(): ?string
    {
        return $this->cognom;
    }

    public function setCognom(string $cognom): self
    {
        $this->cognom = $cognom;

        return $this;
    }

    public function getTelefon(): ?int
    {
        return $this->telefon;
    }

    public function setTelefon(int $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getUsuari(): ?string
    {
        return $this->usuari;
    }

    public function setUsuari(string $usuari): self
    {
        $this->usuari = $usuari;

        return $this;
    }

    public function getContrassenya(): ?string
    {
        return $this->contrassenya;
    }

    public function setContrassenya(string $contrassenya): self
    {
        $this->contrassenya = $contrassenya;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAlta(): ?bool
    {
        return $this->alta;
    }

    public function setAlta(?bool $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    /**
     * @return Collection|Alumne[]
     */
    public function getAlumnes(): Collection
    {
        return $this->alumnes;
    }

    public function addAlumne(Alumne $alumne): self
    {
        if (!$this->alumnes->contains($alumne)) {
            $this->alumnes[] = $alumne;
            $alumne->setProfessor($this);
        }

        return $this;
    }

    public function removeAlumne(Alumne $alumne): self
    {
        if ($this->alumnes->removeElement($alumne)) {
            // set the owning side to null (unless already changed)
            if ($alumne->getProfessor() === $this) {
                $alumne->setProfessor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accio[]
     */
    public function getAccions(): Collection
    {
        return $this->accions;
    }

    public function addAccion(Accio $accion): self
    {
        if (!$this->accions->contains($accion)) {
            $this->accions[] = $accion;
            $accion->setProfessor($this);
        }

        return $this;
    }

    public function removeAccion(Accio $accion): self
    {
        if ($this->accions->removeElement($accion)) {
            // set the owning side to null (unless already changed)
            if ($accion->getProfessor() === $this) {
                $accion->setProfessor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Practica[]
     */
    public function getPractiques(): Collection
    {
        return $this->practiques;
    }

    public function addPractique(Practica $practique): self
    {
        if (!$this->practiques->contains($practique)) {
            $this->practiques[] = $practique;
            $practique->setProfessor($this);
        }

        return $this;
    }

    public function removePractique(Practica $practique): self
    {
        if ($this->practiques->removeElement($practique)) {
            // set the owning side to null (unless already changed)
            if ($practique->getProfessor() === $this) {
                $practique->setProfessor(null);
            }
        }

        return $this;
    }
}