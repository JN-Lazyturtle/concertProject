<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    public const USER1 = 'user1';
    public const USER2 = 'user2';
    public const USER3 = 'user3';

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setFirstname('Bob');
        $user1->setLastname('Leponge');
        $user1->setEmail('bobleponge@gmail.com');
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword('motdepasse');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setFirstname('Saitama');
        $user2->setLastname('Onepunch');
        $user2->setEmail('saitamaonepunch@gmail.com');
        $user2->addArtist($this->getReference(ArtistFixture::AURORA));
        $user2->setPassword('motdepasse');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setFirstname('Hector');
        $user3->setLastname('Junior');
        $user3->setEmail('hectorejunior@gmail.com');
        $user3->addArtist($this->getReference(ArtistFixture::ZIAK));
        $user3->setPassword('motdepasse');
        $manager->persist($user3);

        $manager->flush();

        $this->addReference(self::USER1, $user1);
        $this->addReference(self::USER2, $user2);
        $this->addReference(self::USER3, $user3);
    }

    public function getDependencies()
    {
        return [
            ArtistFixture::class
        ];
    }
}
