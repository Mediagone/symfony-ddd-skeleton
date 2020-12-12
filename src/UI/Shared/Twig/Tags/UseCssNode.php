<?php declare(strict_types=1);

namespace App\UI\Shared\Twig\Tags;

use App\UI\Shared\Twig\AssetsExtension;
use Twig\Compiler;
use Twig\Node\Node;


final class UseCssNode extends Node
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private array $filenames;
    
    
    
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    public function __construct(array $filenames, int $lineno, string $tag)
    {
        $this->filenames = (static fn(string... $t) => $t)(...$filenames);
        parent::__construct([], [], $lineno, $tag);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function compile(Compiler $compiler)
    {
        foreach ($this->filenames as $filename) {
            $compiler->write(AssetsExtension::class . "::addCss('" . $filename . "');\n");
        }
    }
    
    
    
}
