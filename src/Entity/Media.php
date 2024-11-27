<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['movie' => Movie::class, 'serie' => Serie::class])]
abstract class Media
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $longDescription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $coverImage = null;

    #[ORM\Column]
    private array $staff = [];

    #[ORM\Column]
    private array $cast = [];

    #[ORM\OneToMany(mappedBy: 'media', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'media', targetEntity: PlaylistMedia::class, orphanRemoval: true)]
    private Collection $playlistMedias;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'medias')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'medias')]
    private Collection $languages;

    #[ORM\OneToMany(mappedBy: 'media', targetEntity: WatchHistory::class)]
    private Collection $watchHistories;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->playlistMedias = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->watchHistories = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): static
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): static
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getStaff(): array
    {
        return $this->staff;
    }

    public function setStaff(array $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getCast(): array
    {
        return $this->cast;
    }

    public function setCast(array $cast): static
    {
        $this->cast = $cast;

        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMedia($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMedia() === $this) {
                $comment->setMedia(null);
            }
        }

        return $this;
    }

    public function getPlaylistMedias(): Collection
    {
        return $this->playlistMedias;
    }

    public function addPlaylistMedia(PlaylistMedia $playlistMedia): static
    {
        if (!$this->playlistMedias->contains($playlistMedia)) {
            $this->playlistMedias->add($playlistMedia);
            $playlistMedia->setMedia($this);
        }

        return $this;
    }

    public function removePlaylistMedia(PlaylistMedia $playlistMedia): static
    {
        if ($this->playlistMedias->removeElement($playlistMedia)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedia->getMedia() === $this) {
                $playlistMedia->setMedia(null);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->languages->removeElement($language);

        return $this;
    }

    public function getWatchHistories(): Collection
    {
        return $this->watchHistories;
    }

    public function addWatchHistory(WatchHistory $watchHistory): static
    {
        if (!$this->watchHistories->contains($watchHistory)) {
            $this->watchHistories->add($watchHistory);
            $watchHistory->setMedia($this);
        }

        return $this;
    }

    public function removeWatchHistory(WatchHistory $watchHistory): static
    {
        if ($this->watchHistories->removeElement($watchHistory)) {
            // set the owning side to null (unless already changed)
            if ($watchHistory->getMedia() === $this) {
                $watchHistory->setMedia(null);
            }
        }

        return $this;
    }
}
