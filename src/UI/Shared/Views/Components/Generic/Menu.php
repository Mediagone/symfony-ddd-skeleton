<?php declare(strict_types=1);

namespace App\UI\Shared\Views\Components\Generic;

use function array_filter;
use function array_map;


final class Menu
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private array $items;
    
    public function getItems() : array
    {
        return $this->items;
    }




    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $items)
    {
        $this->items = array_filter(
            array_map(static fn($item) => new MenuItem($item), $items),
            static fn($item) => $item->isDisplayed()
        );
    }
    
    
    
}
