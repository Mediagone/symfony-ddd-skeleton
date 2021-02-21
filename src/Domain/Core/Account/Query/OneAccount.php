<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query;

use App\Domain\Core\Account\Query\Specifications\GetAccountByEmail;
use App\Domain\Core\Account\Query\Specifications\GetAccountById;
use App\Domain\Core\Account\Query\Specifications\SelectAccountEntity;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\CQRS\Bus\Domain\Query\SpecificationQuery;
use Mediagone\Doctrine\Specifications\SpecificationRepositoryResult;
use Mediagone\SmallUid\SmallUid;


final class OneAccount extends SpecificationQuery
{
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    public static function asEntity() : self
    {
        return new self(SelectAccountEntity::specification(), SpecificationRepositoryResult::SINGLE_OBJECT);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function byId(SmallUid $id) : self
    {
        $this->addSpecification(GetAccountById::specification($id));
        return $this;
    }
    
    
    public function byEmail(EmailAddress $email) : self
    {
        $this->addSpecification(GetAccountByEmail::specification($email));
        return $this;
    }
    
    
    
}
