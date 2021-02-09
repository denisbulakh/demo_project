<?php
namespace App\Application;

use App\Dto\AdvisorInput;
use App\Dto\AdvisorOutput;
use App\Entity\Advisor;
use Doctrine\Persistence\ObjectManager;
use Psr\Container\ContainerInterface;
use App\Application\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Console\Exception\LogicException;

class CreateAdvisorService
{
    public function __construct(
        private ContainerInterface $container,
        private ValidatorInterface $validator,
        private DtoMapper $dtoMapper,
    ) {}

    private function getEntityManager(): ObjectManager
    {
        if (!$this->container->has('doctrine')) {
            throw new LogicException('The DoctrineBundle is not registered in your application');
        }

        return $this->container->get('doctrine')->getManager();
    }

    /**
     * @param AdvisorInput $advisorInput
     * @return AdvisorOutput
     */
    public function create(AdvisorInput $advisorInput): AdvisorOutput
    {
        $errors = $this->validator->validate($advisorInput);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $advisorEntity = (new Advisor())
            ->setName($advisorInput->name)
            ->setDescription($advisorInput->description)
            ->setAvailability($advisorInput->availability)
            ->setPricePerMinute($advisorInput->pricePerMinute)
            ->setLanguages($advisorInput->languages);

        $this->getEntityManager()->persist($advisorEntity);

        $this->getEntityManager()->flush();

        return $this->dtoMapper->mapAdvisorItemResponseToOutputDto($advisorEntity);
    }
}
