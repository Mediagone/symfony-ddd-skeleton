<?php declare(strict_types=1);

namespace App\UI\Backend\Pages\Views;

use App\Domain\Core\Account\Account;


final class AccountList
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private array $accounts;
    
    public function getAccounts() : array
    {
        return $this->accounts;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================


    public function __construct(array $accounts)
    {
        $this->accounts = (static fn(Account... $accounts) => $accounts)(...$accounts);
    }
    


}
