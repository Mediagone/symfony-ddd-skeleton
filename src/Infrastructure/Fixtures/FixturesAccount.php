<?php declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Core\Account\Account;
use Doctrine\Persistence\ObjectManager;
use Mediagone\Common\Types\Crypto\HashArgon2id;
use Mediagone\Common\Types\Crypto\HashBcrypt;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Symfony\Component\Uid\Ulid;


final class FixturesAccount
{
    public static function load(ObjectManager $em) : void
    {
        $account = new Account(
            new Ulid('01ESTQSNZDJCC5GGVZ1PBYJQER'),
            Name::fromString('Mr'),
            Name::fromString('Admin'),
            EmailAddress::fromString('admin@dev.com'),
            HashBcrypt::fromString('pass')
        );
        $em->persist($account);
        
        $account = new Account(
            new Ulid(),
            Name::fromString('John'),
            Name::fromString('Doe'),
            EmailAddress::fromString('john@dev.com'),
            HashArgon2id::fromString('pass')
        );
        $em->persist($account);
        
        $em->flush();
    }
    
    
    
}
