<?php declare(strict_types=1);

namespace App\UI\Backend;

use App\Domain\Core\Account\Query\ManyAccount;
use App\UI\Backend\Views\Pages\AccountList;
use App\UI\Shared\Services\ControllerResponses;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/accounts", name="backend_account_list", methods={"GET"})
 */
final class AccountListAction
{
    //========================================================================================================
    // Action
    //========================================================================================================
    
    public function __invoke(QueryBus $queryBus, ControllerResponses $responses) : Response
    {
        $users = $queryBus->find(ManyAccount::asEntity());

        return $responses->template('Backend/Views/Pages/AccountList.twig', [
            'MODEL' => new AccountList($users),
        ]);
    }
    
    
    
}
