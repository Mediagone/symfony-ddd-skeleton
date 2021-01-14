<?php declare(strict_types=1);

namespace App\UI\Backend\Views\Components\Layout;

use App\UI\Frontend\SecurityUser;


final class Header
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private HeaderUser $user;
    
    public function getUser() : HeaderUser
    {
        return $this->user;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(SecurityUser $user)
    {
        $this->user = new HeaderUser($user);
    }
    
    
    
}
