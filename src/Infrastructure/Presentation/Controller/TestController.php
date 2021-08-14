<?php
namespace App\Infrastructure\Presentation\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    /**
     * @Route("/wp-json/app/api/test/", name="test")
     */
    public function test(): Response
    {
        $responseData = ['test_key' => 'test_value'];
        return new JsonResponse($responseData);
    }
}