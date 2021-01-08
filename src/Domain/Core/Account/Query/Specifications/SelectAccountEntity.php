<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query\Specifications;

use App\Domain\Core\Account\Account;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Mediagone\Doctrine\Specifications\Specification;


final class SelectAccountEntity implements Specification
{
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    private function __construct()
    {
    
    }
    
    
    public static function specification() : self
    {
        return new self();
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function modifyBuilder(QueryBuilder $builder) : void
    {
        $builder
            ->from(Account::class, 'account')
            ->select('account')
        ;
    }
    
    
    public function modifyQuery(Query $query) : void
    {
        // Do nothing
    }
    
    
    
}
