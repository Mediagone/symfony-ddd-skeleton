<?php declare(strict_types=1);

namespace App\UI\Shared\Views\Components;


final class PageHeader
{
    
    private ?object $user;
    
    
    public function getUser() : ?object
    {
        return $this->user;
    }
    
    
    
    public function __construct(?object $user)
    {
        $this->user = $user;
    }
    
    
    
}
