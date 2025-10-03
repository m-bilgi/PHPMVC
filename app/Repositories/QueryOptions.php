<?php
declare(strict_types=1);

namespace App\Repositories;

class QueryOptions
{
    public string $procType;
    public string $langValue;
    public ?string $anyValue01;
    public ?string $anyValue02;

    public function __construct(
        string $procType = 'DEFAULT',
        string $langValue = 'TR',
        ?string $anyValue01 = null,
        ?string $anyValue02 = null
    ) {
        $this->procType = $procType;
        $this->langValue = $langValue;
        $this->anyValue01 = $anyValue01;
        $this->anyValue02 = $anyValue02;
    }

    public function toArray(): array
    {
        return [
            'procType'  => $this->procType,
            'langValue' => $this->langValue,
            'anyValue01'=> $this->anyValue01,
            'anyValue02'=> $this->anyValue02,
        ];
    }
}
