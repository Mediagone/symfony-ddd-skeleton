<?php declare(strict_types=1);

namespace App\UI\Backend\Views\Components\Layout;

use App\UI\Frontend\SecurityUser;
use App\UI\Shared\Views\Components\Generic\Menu;


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
    
    
    private ?Menu $menu;
    
    public function getMenu() : ?Menu
    {
        return $this->menu;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(SecurityUser $user, ?Menu $menu = null)
    {
        $this->user = new HeaderUser($user);
        $this->menu = $menu;
    }
    
    
    
}
