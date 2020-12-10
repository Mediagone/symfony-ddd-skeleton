<?php declare(strict_types=1);

namespace App\UI\Frontend\Pages;

use App\UI\Shared\ControllerResponses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="frontend_index", methods={"GET"})
 */
final class Index
{
    public function __invoke(ControllerResponses $responses) : Response
    {
        return $responses->template('Frontend/Pages/Index.twig');
    }
}
