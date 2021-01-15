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
    
    
    private string $attrClass;

    public function getAttrClass() : string
    {
        return $this->attrClass;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $items, array $options = [])
    {
        $this->items = array_filter(
            array_map(static fn($item) => new MenuItem(
                $item,
                $options['submenuIndicatorHtml'] ?? '',
                $options['submenuAttrClass'] ?? '',
            ), $items),
            static fn($item) => $item->isDisplayed()
        );
        $this->attrClass = $options['attrClass'] ?? '';
    }
    
    
    
}
