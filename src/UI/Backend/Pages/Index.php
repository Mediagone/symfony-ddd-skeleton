<?php declare(strict_types=1);

namespace App\UI\Backend\Pages;

use App\UI\Shared\ControllerResponses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="backend_index", methods={"GET"})
 */
final class Index
{
    public function __invoke(ControllerResponses $responses) : Response
    {
        return $responses->template('Backend/Pages/Index.twig');
    }
}
