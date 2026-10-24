<?php declare(strict_types=1);

namespace App\Entity;

use App\Model\Pohlavi;
use App\Repository\YetiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YetiRepository::class)]
class Yeti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options:['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private string $jmeno = '';

    #[ORM\Column(enumType: Pohlavi::class)]
    private ?Pohlavi $pohlavi = null;

    #[ORM\Column]
    private int $vyska = 0;

    #[ORM\Column]
    private int $vaha = 0;

    #[ORM\Column(length: 120)]
    private string $bydliste = '';

    #[ORM\Column(type: Types::STRING, nullable: true, length: 500)]
    private ?string $popis = null;

    #[ORM\Column]
    private \DateTimeImmutable $datumVytvoreni;

    /**
     * @var Collection<int, Hodnoceni>
     */
    #[ORM\OneToMany(targetEntity: Hodnoceni::class, mappedBy: 'yeti', orphanRemoval: true)]
    private Collection $hodnoceni;


    public function __construct()
    {
        $this->datumVytvoreni = new \DateTimeImmutable();
        $this->hodnoceni = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): static
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getVyska(): int
    {
        return $this->vyska;
    }

    public function setVyska(int $vyska): static
    {
        $this->vyska = $vyska;

        return $this;
    }

    public function getVaha(): int
    {
        return $this->vaha;
    }

    public function setVaha(int $vaha): static
    {
        $this->vaha = $vaha;

        return $this;
    }

    public function getBydliste(): string
    {
        return $this->bydliste;
    }

    public function setBydliste(string $bydliste): static
    {
        $this->bydliste = $bydliste;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->popis;
    }

    public function setPopis(?string $popis): static
    {
        $this->popis = $popis;

        return $this;
    }

    public function getDatumVytvoreni(): \DateTimeImmutable
    {
        return $this->datumVytvoreni;
    }

    /**
     * @return Collection<int, Hodnoceni>
     */
    public function getHodnoceni(): Collection
    {
        return $this->hodnoceni;
    }

    public function getPohlavi(): ?Pohlavi
    {
        return $this->pohlavi;
    }

    public function setPohlavi(Pohlavi $pohlavi): static
    {
        $this->pohlavi = $pohlavi;

        return $this;
    }
}
