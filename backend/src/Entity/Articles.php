<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticlesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

// ce sont des attribut
#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
#[ApiResource(
    //pour passer en format json
    normalizationContext: ['groups' => ['read:collection']],

    // controller les opération possible (post / get / put ...)
    itemOperations: [
        'put',
        'delete',
        'get' => [
            'normalization_context' => ['groups' => ['read:collection']],
        ]
    ]
)]

class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // attribut php pour trier
    #[Groups('read:collection')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('read:collection', 'write:Post')]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('read:collection', 'write:Post')]
    private $slug;

    #[ORM\Column(type: 'text')]
    #[Groups('read:collection')]
    private $content;

    #[ORM\Column(type: 'datetime')]
    #[Groups('read:item')]
    private $createAt;

    #[ORM\Column(type: 'datetime')]
    private $updateAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('read:collection')]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[Groups('read:item')]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('read:collection')]
    private $photo;

    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updateAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
