<?php
namespace App\Application;

use App\Dto\AdvisorInput;
use App\Dto\AdvisorOutput;
use App\Entity\Advisor;
use JetBrains\PhpStorm\Pure;

class DtoMapper
{
    #[Pure] public function mapRequestBodyToInputDto(array $bodyParameters): AdvisorInput
    {
        return new AdvisorInput(
            name: $bodyParameters['name'] ?? null,
            description: $bodyParameters['description'] ?? null,
            availability: $bodyParameters['availability'] ?? false,
            pricePerMinute: $bodyParameters['pricePerMinute'] ?? null,
            languages: $bodyParameters['languages'] ?? [],
            image: $bodyParameters['image'] ?? null,
        );
    }

    #[Pure] public function mapAdvisorItemResponseToOutputDto(Advisor $advisorEntity): AdvisorOutput
    {
        return new AdvisorOutput(
            id: $advisorEntity->getId(),
            name: $advisorEntity->getName(),
            description: $advisorEntity->getDescription(),
            availability: $advisorEntity->getAvailability(),
            pricePerMinute: $advisorEntity->getPricePerMinute(),
            languages: $advisorEntity->getLanguages(),
            image: $advisorEntity->getImage(),
        );
    }
}
