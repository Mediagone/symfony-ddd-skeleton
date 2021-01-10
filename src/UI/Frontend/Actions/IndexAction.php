<?php declare(strict_types=1);

namespace App\UI\Frontend\Actions;

use App\UI\Backend\Partials\BackendHeader;
use App\UI\Shared\Services\ControllerResponses;
use App\UI\Shared\Partials\PageHeader;
use App\UI\Shared\Partials\PageMenu;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Ulid;


/**
 * @Route("/", name="frontend_index", methods={"GET"})
 */
final class IndexAction
{
    public function __invoke(ControllerResponses $responses, QueryBus $queryBus) : Response
    {
        /*$id = new Ulid();
        dump($id);
        dump((string)$id);
        dump($id->toBinary());
        dump($id->toBase58());
        dump($id->toBase32());
        dump(new Ulid((string)$id));*/
        dump(new Ulid());
        dump(new Ulid());
        dump(new Ulid());
        dump(new Ulid());
        
        
        
        return $responses->template('Frontend/Pages/Index.twig', [
            'HEADER' => new PageHeader(null),
            //'MENU' => new PageMenu(),
            //'MENU' => new BackendHeader(),
            'FOOTER' => new BackendHeader(),
        ]);
    }
}
