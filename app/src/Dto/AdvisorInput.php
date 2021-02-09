<?php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class AdvisorInput {
    public function __construct(
        /**
         * @Assert\NotBlank(allowNull=false)
         * @var string $name
         */
        public string $name,

        /**
         * @var string|null $description
         */
        public string|null $description,

        /**
         * @Assert\NotNull()
         * @var bool $availability
         */
        public bool $availability,

        /**
         * @Assert\PositiveOrZero()
         * @Assert\NotNull()
         * @var float $pricePerMinute
         */
        public float $pricePerMinute,

        /**
         * @Assert\All({
         *     @Assert\Language()
         * })
         * @Assert\NotNull()
         * @var string[] $languages
         */
        public array $languages = [],

        /**
         * @Assert\Image(binaryFormat=true, maxSize=250000)
         * @var string|null`$image
         */
        public string|null $image = null,
    ) {}
}
