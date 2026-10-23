<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\HodnoceniRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HodnoceniRepository::class)]
#[ORM\Index(columns: ['datum_hodnoceni'])]
class Hodnoceni
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hodnoceni')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Yeti $yeti = null;

    #[ORM\Column(type: 'smallint')]
    private int $hodnota;

    #[ORM\Column]
    private \DateTimeImmutable $datumHodnoceni;

    public function __construct(Yeti $yeti, int $hodnota)
    {
        $this->yeti = $yeti;
        $this->hodnota = $hodnota;
        $this->datumHodnoceni = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYeti(): ?Yeti
    {
        return $this->yeti;
    }

    public function getHodnota(): int
    {
        return $this->hodnota;
    }

    public function getDatumHodnoceni(): \DateTimeImmutable
    {
        return $this->datumHodnoceni;
    }
}
