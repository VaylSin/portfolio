<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Url = null;

    #[ORM\Column(length: 255)]
    private ?string $Alt = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    /**
     * @var Collection<int, Customers>
     */
    #[ORM\ManyToMany(targetEntity: Customers::class, mappedBy: 'Images')]
    private Collection $customers;

    /**
     * @var Collection<int, Customers>
     */
    #[ORM\ManyToMany(targetEntity: Customers::class, inversedBy: 'images')]
    private Collection $Customers;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'Images')]
    private Collection $projects;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'images')]
    private Collection $Project;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->Customers = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->Project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): static
    {
        $this->Url = $Url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->Alt;
    }

    public function setAlt(string $Alt): static
    {
        $this->Alt = $Alt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

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
            $customer->addImage($this);
        }

        return $this;
    }

    public function removeCustomer(Customers $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeImage($this);
        }

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
            $project->addImage($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeImage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProject(): Collection
    {
        return $this->Project;
    }

}
