<?php declare(strict_types=1);

namespace App\UI\Shared\Twig\Tags;

use Twig\Error\SyntaxError;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use function array_map;


/**
 * Register Javascript assets. 
 *
 *    {% use_js "/assets/scripts.js" %}
 *    {% use_js "/assets/scripts.js", "/assets/other_scripts.js" %}
 */
final class UseJsTokenParser extends AbstractTokenParser
{
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function parse(Token $token): Node
    {
        $stream = $this->parser->getStream();

        $targets = [];
        while (true) {
            $target = $this->parser->getExpressionParser()->parseExpression();
            if (!$target instanceof ConstantExpression) {
                throw new SyntaxError('The template references in a "use" statement must be a string.', $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }

            $targets[] = $target;

            if (!$stream->nextIf(Token::PUNCTUATION_TYPE, ',')) {
                break;
            }
        }
        
        $stream->expect(Token::BLOCK_END_TYPE);
        
        $filenames = array_map(static fn($t) => $t->getAttribute('value'), $targets);
        return new UseJsNode($filenames, $token->getLine(), $this->getTag());
    }
    
    
    public function getTag(): string
    {
        return 'use_js';
    }
    
    
    
}
