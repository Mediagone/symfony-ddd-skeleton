<?php declare(strict_types=1);

namespace App\UI\Backend;

use App\Domain\Core\Account\Account;
use App\Domain\Core\Account\Command\ModifyAccount;
use App\UI\Backend\Forms\AccountEditForm;
use App\UI\Backend\Forms\AccountEditFormData;
use App\UI\Backend\Views\Pages\AccountShow;
use App\UI\Shared\Services\ControllerFlashes;
use App\UI\Shared\Services\ControllerResponses;
use Exception;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\CQRS\Bus\Domain\Command\CommandBus;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/accounts/{accountId}", name="backend_account_show", methods={"GET|POST"})
 */
final class AccountShowAction
{
    public function __invoke(
        Account $account,
        Request $request,
        CommandBus $commandBus,
        ControllerFlashes $flashes,
        ControllerResponses $responses,
        FormFactoryInterface $formFactory
    ) : Response
    {
        $form = $formFactory->create(AccountEditForm::class, new AccountEditFormData($account));
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /** @var AccountEditFormData $data */
                $accountData = $form->getData();
                
                try {
                    $commandBus->do(new ModifyAccount(
                        $account,
                        Name::fromString($accountData->getLastname()),
                        Name::fromString($accountData->getForename()),
                        EmailAddress::fromString($accountData->getEmail()),
                    ));
                    
                    $flashes->success('form.flashes.successful_operation', 'backend');
                }
                catch (Exception $error) {
                    $flashes->alert('form.flashes.unexpected_error', 'backend');
                }
            }
            else {
                $flashes->warning('form.flashes.invalid_data', 'backend');
            }
        }
        
        return $responses->template('Backend/Views/Pages/AccountShow.twig', [
            'MODEL' => new AccountShow($account, $form->createView()),
        ]);
    }
}