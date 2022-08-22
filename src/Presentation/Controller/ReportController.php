<?php

namespace App\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class ReportController extends AbstractController
{
    #[Route('/generate-report', name: 'report_generate')]
    public function generate(Request $request): JsonResponse
    {
        return new JsonResponse('Hello');
    }
}