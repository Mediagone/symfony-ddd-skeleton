<?php declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Core\Account\Account;
use Doctrine\Persistence\ObjectManager;
use Mediagone\Common\Types\Crypto\HashArgon2id;
use Mediagone\Common\Types\Crypto\HashBcrypt;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\SmallUid\SmallUid;


final class FixturesAccount
{
    public static function load(ObjectManager $em) : void
    {
        $account = new Account(
            SmallUid::fromString('1GUDp752fwX'),
            Name::fromString('Mr'),
            Name::fromString('Admin'),
            EmailAddress::fromString('admin@dev.com'),
            HashBcrypt::fromString('pass')
        );
        $em->persist($account);
        
        $account = new Account(
            SmallUid::fromString('5X7Xks6hxoX'),
            Name::fromString('John'),
            Name::fromString('Doe'),
            EmailAddress::fromString('john@dev.com'),
            HashArgon2id::fromString('pass')
        );
        $em->persist($account);
        
        $em->flush();
    }
    
    
    
}
