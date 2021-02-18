<?php declare(strict_types=1);

namespace App\UI\Frontend;

use App\UI\Frontend\Views\Pages\Index;
use App\UI\Shared\Services\ControllerResponses;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="frontend_index", methods={"GET"})
 */
final class IndexAction
{
    //========================================================================================================
    // Action
    //========================================================================================================
    
    public function __invoke(ControllerResponses $responses, QueryBus $queryBus) : Response
    {
        return $responses->template('Frontend/Views/Pages/Index.twig', [
            'MODEL' => new Index(),
        ]);
    }
    
    
    
}