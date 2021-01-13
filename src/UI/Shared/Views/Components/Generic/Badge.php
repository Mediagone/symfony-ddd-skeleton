<?php declare(strict_types=1);

namespace App\UI\Shared\Views\Components\Generic;


use InvalidArgumentException;

final class Badge
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private string $label;
    
    public function getLabel() : string
    {
        return $this->label;
    }
    
    
    private string $type;
    
    public function getType() : string
    {
        return $this->type;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(array $data)
    {
        $this->label = $data['label'] ?? '';
        $this->type = $data['type'] ?? 'default';
        
        if (!in_array($this->type, ['default','success','danger','warning','info','primary'])) {
            throw new InvalidArgumentException('Unsupported badge type ('.$this->type.'), supported values are: default, success, danger, warning, info, primary.');
        }
    }
    
    
    
}
