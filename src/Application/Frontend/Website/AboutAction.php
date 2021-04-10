<?php declare(strict_types=1);

namespace App\Application\Frontend\Website;

use App\Application\Frontend\Website\Views\Pages\About;
use App\Application\Shared\Services\ControllerResponses;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="frontend_about", methods={"GET"})
 */
final class AboutAction
{
    //========================================================================================================
    // Action
    //========================================================================================================
    
    public function __invoke(ControllerResponses $responses, QueryBus $queryBus) : Response
    {
        return $responses->template('Frontend/Views/Pages/About.twig', [
            'MODEL' => new About(),
        ]);
    }
    
    
    
}
