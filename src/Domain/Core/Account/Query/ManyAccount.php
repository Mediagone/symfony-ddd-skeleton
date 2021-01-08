<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query;

use App\Domain\Core\Account\Query\Specifications\FilterAccountWithForenameOrLastnameLike;
use App\Domain\Core\Account\Query\Specifications\SelectAccountCount;
use App\Domain\Core\Account\Query\Specifications\SelectAccountEntity;
use Mediagone\CQRS\Bus\Domain\Query\SpecificationQuery;
use Mediagone\Doctrine\Specifications\SpecificationRepositoryResult;


final class ManyAccount extends SpecificationQuery
{
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    public static function asEntity() : self
    {
        return new self(SelectAccountEntity::specification(), SpecificationRepositoryResult::MANY_OBJECTS);
    }
    
    
    public static function asCount() : self
    {
        return new self(SelectAccountCount::specification(), SpecificationRepositoryResult::SINGLE_SCALAR);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function withForenameOrLastnameLike(string $search) : self
    {
        $this->addSpecification(FilterAccountWithForenameOrLastnameLike::specification($search));
        return $this;
    }
    
    
    
}
