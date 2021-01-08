<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query\Specifications;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\Doctrine\Specifications\Specification;


final class GetAccountByEmail implements Specification
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private EmailAddress $email;
    
    
    
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    private function __construct(EmailAddress $email)
    {
        $this->email = $email;
    }
    
    
    public static function specification(EmailAddress $email) : self
    {
        return new self($email);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function modifyBuilder(QueryBuilder $builder) : void
    {
        $builder
            ->andWhere("account.email = :email")
            ->setParameter('email', $this->email, 'app_email')
        ;
    }
    
    
    public function modifyQuery(Query $query) : void
    {
        // Do nothing
    }
    
    
    
}
