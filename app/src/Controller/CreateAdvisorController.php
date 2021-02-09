<?php
namespace App\Controller;

use App\Application\CreateAdvisorService;
use App\Application\DtoMapper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Application\Exception\ValidationException;
use Symfony\Component\Routing\Annotation\Route;
use TypeError;

class CreateAdvisorController extends AbstractController
{
    public function __construct(private LoggerInterface $logger) {}

    /**
     * @Route("/api/v1/advisors",methods={"post"},name="create_advisor")
     * @param Request $request
     * @param CreateAdvisorService $service
     * @param DtoMapper $dtoMapper
     * @return JsonResponse
     */
    public function index(Request $request, CreateAdvisorService $service, DtoMapper $dtoMapper): JsonResponse
    {
        try {
            return new JsonResponse($service->create($dtoMapper->mapRequestBodyToInputDto(
                json_decode($request->getContent(), true)
            )));
        } catch (TypeError | BadRequestHttpException $e) {
            $this->logger->warning($e->getMessage());
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        } catch (ValidationException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
