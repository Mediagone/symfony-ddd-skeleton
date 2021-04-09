<?php declare(strict_types=1);

namespace App\Application\Shared\Views\Components\Generic;


final class NavBadge
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private string $label;
    
    public function getLabel() : string
    {
        return $this->label;
    }
    
    
    private string $title;

    public function getTitle() : string
    {
        return $this->title;
    }
    
    
    private string $attrClass;
    
    public function getAttrClass() : string
    {
        return $this->attrClass;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $data)
    {
        $this->label = $data['label'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->attrClass = $data['attrClass'] ?? '';
    }
    
    
    
}
