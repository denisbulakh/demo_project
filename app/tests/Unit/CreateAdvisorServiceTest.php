<?php
namespace App\Tests\Unit;

use App\Application\CreateAdvisorService;
use App\Application\DtoMapper;
use App\Dto\AdvisorInput;
use App\Dto\AdvisorOutput;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAdvisorServiceTest extends TestCase
{
    /**
     * @dataProvider inputOuputObjects
     * @param AdvisorInput $advisorInput
     * @param AdvisorOutput $expectedAdvisorOutput
     */
    public function testAdvisorCreate(AdvisorInput $advisorInput, AdvisorOutput $expectedAdvisorOutput)
    {
        $entityManagerMock = $this->createMock(ObjectManager::class);
        $entityManagerMock->method('persist')->will($this->returnCallback(function($advisor) {
            $advisor->setId(10);
        }));
        $entityManagerMock->method('flush');

        $managerRegistryMock = $this->createMock(ManagerRegistry::class);
        $managerRegistryMock->method('getManager')->willReturn($entityManagerMock);

        $containerMock = $this->createMock(ContainerInterface::class);
        $containerMock->method('has')->with('doctrine')->willReturn(true);
        $containerMock->method('get')->with('doctrine')->willReturn($managerRegistryMock);

        $validatorMock = $this->createMock(ValidatorInterface::class);
        $validatorMock->method('validate')->willReturn([]);

        $createAdvisorService = new CreateAdvisorService(
            container: $containerMock,
            validator: $validatorMock,
            dtoMapper: new DtoMapper()
        );

        $result = $createAdvisorService->create($advisorInput);

        $this->assertEquals($result, $expectedAdvisorOutput);
    }

    public function inputOuputObjects(): array
    {
        return [
            [
                new AdvisorInput(
                    name: 'Test name',
                    description: 'Test description',
                    availability: false,
                    pricePerMinute: 12.50,
                    languages: ['de', 'fr'],
                    image: null,
                ),
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
