<?php declare(strict_types=1);

namespace App\UI\Backend\Pages\Actions;

use App\Domain\Core\Account\Query\ManyAccount;
use App\UI\Backend\Pages\Views\AccountList;
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

        return $responses->template('Backend/Pages/Views/AccountList.twig', [
            'MODEL' => new AccountList($users),
        ]);
    }
    
    
    
}
