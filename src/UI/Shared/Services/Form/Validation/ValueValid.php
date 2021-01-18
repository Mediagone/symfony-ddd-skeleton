<?php declare(strict_types=1);

namespace App\UI\Shared\Services\Form\Validation;

use Symfony\Component\Validator\Constraint;


/**
 * Checks if a value validates a ValueObject's constraint. Usage example:
 *      @ValueValid(class=Slug::class, message="form.slug_is_invalid")
 * 
 * @Annotation
 */
final class ValueValid extends Constraint
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    /** @var string $class The name of a class implementing Mediagone\Common\Types\ValueObject */
    public string $class;
    
    public string $message = 'The value does not match the specified value-object class validation.';
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function getRequiredOptions() : array
    {
        return ['class'];
    }
    
    
    
}
