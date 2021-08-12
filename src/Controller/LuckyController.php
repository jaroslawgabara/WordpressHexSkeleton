<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    /**
     * @Route("/wp-json/app/api/aa/", name="app_lucky_number")
     */
    public function number(): Response
    {
        $number = 1;

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}