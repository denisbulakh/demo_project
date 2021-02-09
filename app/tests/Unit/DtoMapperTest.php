<?php
namespace App\Tests\Unit;

use App\Application\DtoMapper;
use App\Dto\AdvisorInput;
use App\Dto\AdvisorOutput;
use App\Entity\Advisor;
use PHPUnit\Framework\TestCase;

class DtoMapperTest extends TestCase
{
    /**
     * @dataProvider requestBody
     * @param array $requestBody
     * @param AdvisorInput $expectedInputDto
     */
    public function testMapRequestBodyToAdvisorInputDto(array $requestBody, AdvisorInput $expectedInputDto)
    {
        $mapper = new DtoMapper();
        $result = $mapper->mapRequestBodyToInputDto($requestBody);

        $this->assertEquals($expectedInputDto, $result);
    }

    /**
     * @dataProvider outputData
     * @param Advisor $advisor
     * @param AdvisorOutput $expectedOutputObject
     */
    public function testMapAdvisorItemResponseToOutputDto(Advisor $advisor, AdvisorOutput $expectedOutputObject)
    {
        $mapper = new DtoMapper();
        $result = $mapper->mapAdvisorItemResponseToOutputDto($advisor);

        $this->assertEquals($expectedOutputObject, $result);
    }

    public function requestBody(): array
    {
        return [
            [
                [
                    "name" => 'Test name',
                    "description" => 'Test description',
                    "pricePerMinute" => 12.50,
                    "languages" => ['de', 'fr'],
                ],
                new AdvisorInput(
                    name: 'Test name',
                    description: 'Test description',
                    availability: false,
                    pricePerMinute: 12.50,
                    languages: ['de', 'fr'],
                    image: null,
                ),
            ],
            [
                [
                    "name" => 'Test name',
                    "pricePerMinute" => 12.50,
                    "languages" => [],
                    "availability" => true,
                ],
                new AdvisorInput(
                    name: 'Test name',
                    description: null,
                    availability: true,
                    pricePerMinute: 12.50,
                    languages: [],
                    image: null,
                ),
            ]
        ];
    }

    public function outputData(): array
    {
        return [
            [
                (new Advisor())
                    ->setId(10)
                    ->setName('Test name')
                    ->setDescription('Test description')
                    ->setAvailability(false)
                    ->setPricePerMinute(12.50)
                    ->setLanguages(['de', 'fr']),
                new AdvisorOutput(
                    id: 10,
                    name: 'Test name',
                    description: 'Test description',
                    availability: false,
                    pricePerMinute: 12.50,
                    languages: ['de', 'fr'],
                    image: null,
                ),
            ]
        ];
    }
}
