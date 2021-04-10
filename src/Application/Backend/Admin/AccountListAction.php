<?php declare(strict_types=1);

namespace App\Application\Backend\Admin;

use App\Application\Backend\Admin\Views\Pages\AccountList;
use App\Application\Shared\Services\ControllerResponses;
use App\Domain\Core\Account\Query\ManyAccount;
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

        return $responses->template('Backend/Admin/Views/Pages/AccountList.twig', [
            'MODEL' => new AccountList($users),
        ]);
    }
    
    
    
}
