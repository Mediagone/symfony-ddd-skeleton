<?php declare(strict_types=1);

namespace App\UI\Shared\Views\Components\Generic;

use function array_filter;
use function array_map;


final class MenuItem
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private string $header;

    public function getHeader() : string
    {
        return $this->header;
    }

    private string $label;

    public function getLabel() : string
    {
        return $this->label;
    }


    private string $href;

    public function getHref() : string
    {
        return $this->href;
    }


    private string $fa;

    public function getFa() : string
    {
        return $this->fa;
    }


    private bool $isDisplayed;

    public function isDisplayed() : bool
    {
        return $this->isDisplayed;
    }
    
    
    private array $items;
    
    public function getItems() : array
    {
        return $this->items;
    }

    public function hasItems() : bool
    {
        return !empty($this->items);
    }


    private array $badges;

    public function getBadges() : array
    {
        return $this->badges;
    }
    


    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $data)
    {
        $this->header = $data['header'] ?? '';
        $this->label = $data['label'] ?? '';
        $this->href = $data['href'] ?? '';
        $this->fa = $data['fa'] ?? '';
        $this->isDisplayed = $data['visible'] ?? true === true;
        $this->items = $this->buildSubItems($data['items'] ?? []);
        $this->badges = $this->buildBadges($data['badges'] ?? []);
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================
    
    private function buildSubItems(array $items) : array
    {
        return array_filter(
            array_map(static fn($item) => new MenuItem($item), $items),
            static fn($item) => $item->isDisplayed()
        );
    }
    
    
    private function buildBadges(array $badges) : array
    {
        return array_map(static fn($badge) => new Badge($badge), $badges);
    }
    
    
    
}
