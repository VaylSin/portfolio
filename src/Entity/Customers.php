<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url_project = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'customers')]
    private Collection $tags;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'customers')]
    private Collection $Images;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\ManyToMany(targetEntity: Image::class, mappedBy: 'Customers')]
    private Collection $images;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->Images = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getUrlProject(): ?string
    {
        return $this->url_project;
    }

    public function setUrlProject(string $url_project): static
    {
        $this->url_project = $url_project;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->Images->contains($image)) {
            $this->Images->add($image);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        $this->Images->removeElement($image);

        return $this;
    }


}
