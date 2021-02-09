<?php
namespace App\Dto;

final class AdvisorOutput {
    public function __construct(
        public int $id,
        public string $name,
        public string|null $description,
        public bool $availability,
        public float $pricePerMinute,
        public array $languages = [],
        public string|null $image = null,
    ) {}
}
