<?php declare(strict_types=1);

namespace App\UI\Shared\Services\Twig;

use App\UI\Shared\Twig\Tags\UseCssTokenParser;
use App\UI\Shared\Twig\Tags\UseJsTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


final class AssetsExtension extends AbstractExtension
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private static array $stylesheets = [];
    
    public static function addCss(string $filepath) : void
    {
        if (! isset(self::$stylesheets[$filepath])) {
            self::$stylesheets[$filepath] = $filepath;
        }
    }
    
    
    private static array $javascripts = [];
    
    public static function addJavascript(string $filepath) : void
    {
        if (! isset(self::$javascripts[$filepath])) {
            self::$javascripts[$filepath] = $filepath;
        }
    }
    
    
    
    //========================================================================================================
    //
    //========================================================================================================
    
    public function getName() : string
    {
        return 'AssetsExtension';
    }
    
    
    public function getFunctions() : array
    {
        return [
        ];
    }
    
    
    public function getTokenParsers() : array
    {
        return [
        ];
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================
    
    public function getStylesheets() : array
    {
        return self::$stylesheets;
    }
    
    
    public function getJavascripts() : array
    {
        return self::$javascripts;
    }
    
    
    
}
