<?php declare(strict_types=1);

namespace App\Model;

enum Pohlavi: int
{
    case Samec = 1;
    case Samice = 2;
    case Jine = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::Samec => 'Samec',
            self::Samice => 'Samice',
            self::Jine => 'Jiné',
        };
    }
}
