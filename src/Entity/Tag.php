<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'tags')]
    private Collection $projects;

    /**
     * @var Collection<int, Customers>
     */
    #[ORM\ManyToMany(targetEntity: Customers::class, mappedBy: 'tags')]
    private Collection $customers;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addTag($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Customers>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customers $customer): static
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addTag($this);
        }

        return $this;
    }

    public function removeCustomer(Customers $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeTag($this);
        }

        return $this;
    }
}