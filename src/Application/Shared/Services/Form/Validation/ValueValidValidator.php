<?php declare(strict_types=1);

namespace App\Application\Shared\Services\Form\Validation;

use LogicException;
use Mediagone\Common\Types\ValueObject;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


final class ValueValidValidator extends ConstraintValidator
{
    //========================================================================================================
    //
    //========================================================================================================
    
    /**
     * @param ValueValid $constraint
     */
    public function validate($value, Constraint $constraint) : void
    {
        $validatorClassName = (string)$constraint->class;
        
        if (! class_exists($validatorClassName)) {
            throw new LogicException("The validation class ($validatorClassName) doesn't exists.");
        }
        
        if (! is_a($validatorClassName, ValueObject::class, true)) {
            throw new LogicException("The validation class ($validatorClassName) must implement " . ValueObject::class . ' interface.');
        }
        
        // Custom constraints should ignore null and empty values to allow other constraints to take care of that.
        if ($value === null || $value === '') {
            return;
        }
        
        /** @var ValueObject $validatorClassName */
        if (! $validatorClassName::isValueValid($value)) {
            $this->context->addViolation($constraint->message ?? 'Default message', ['{{ value }}' => $value]);
        }
    }
    
    
    
}
