<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ParentEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ParentEntityRepository::class)]
#[ApiResource(
    shortName: 'Parent',
    normalizationContext: ['groups' => ['parent:read']],
    denormalizationContext: ['groups' => ['parent:write']],
)]
class ParentEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['parent:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['parent:read', 'parent:write'])]
    private ?string $name = null;

    /**
     * @var Collection<int, ChildEntity>
     */
    #[ORM\OneToMany(targetEntity: ChildEntity::class, mappedBy: 'parent', cascade: ['persist'])]
    #[Groups(['parent:write'])]
    private Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
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
     * @return Collection<int, ChildEntity>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(ChildEntity $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(ChildEntity $child): static
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    #[Groups(['parent:read'])]
    public function getChildrenCount(): int
    {
        return $this->children->count();
    }
}
