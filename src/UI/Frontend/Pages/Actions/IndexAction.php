<?php declare(strict_types=1);

namespace App\UI\Frontend\Pages\Actions;

use App\UI\Frontend\Pages\Views\Index;
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
        return $responses->template('Frontend/Pages/Views/Index.twig', [
            'MODEL' => new Index(),
        ]);
    }
    
    
    
}
