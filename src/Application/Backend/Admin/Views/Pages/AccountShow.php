<?php declare(strict_types=1);

namespace App\Application\Backend\Admin\Views\Pages;

use App\Domain\Core\Account\Account;
use Symfony\Component\Form\FormView;


final class AccountShow
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private Account $account;
    
    public function getAccount() : Account
    {
        return $this->account;
    }
    
    
    private FormView $accountEditForm;
    
    public function getAccountEditForm() : FormView
    {
        return $this->accountEditForm;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Account $account, FormView $form)
    {
        $this->account = $account;
        $this->accountEditForm = $form;
    }
    
    
    
}
