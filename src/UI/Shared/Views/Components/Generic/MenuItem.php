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


    private string $attrClass;

    public function getAttrClass() : string
    {
        return $this->attrClass;
    }


    private array $badges;

    public function getBadges() : array
    {
        return $this->badges;
    }


    private string $submenuIndicatorHtml;

    public function getSubmenuIndicatorHtml() : string
    {
        return $this->submenuIndicatorHtml;
    }


    private string $submenuAttrClass;

    public function getSubmenuAttrClass() : string
    {
        return $this->submenuAttrClass;
    }
    


    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $data, string $submenuIndicatorHtml, string $submenuAttrClass)
    {
        $this->header = $data['header'] ?? '';
        $this->label = $data['label'] ?? '';
        $this->href = $data['href'] ?? '';
        $this->fa = $data['fa'] ?? '';
        $this->attrClass = $data['attrClass'] ?? '';
        $this->isDisplayed = ($data['visible'] ?? true) === true;
        $this->submenuIndicatorHtml = $submenuIndicatorHtml;
        $this->submenuAttrClass = $submenuAttrClass;
        $this->items = $this->buildSubItems($data['items'] ?? []);
        $this->badges = $this->buildBadges($data['badges'] ?? []);
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================
    
    private function buildSubItems(array $items) : array
    {
        return array_filter(
            array_map(fn($item) => new MenuItem($item, $this->submenuIndicatorHtml, $this->submenuAttrClass), $items),
            static fn($item) => $item->isDisplayed()
        );
    }
    
    
    private function buildBadges(array $badges) : array
    {
        return array_map(static fn($badge) => new Badge($badge), $badges);
    }
    
    
    
}
