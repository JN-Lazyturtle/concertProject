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
        $user1->setMailU('bobleponge@gmail.com');
        $user1->setIsAdmin(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setFirstname('Saitama');
        $user2->setLastname('Onepunch');
        $user2->setMailU('saitamaonepunch@gmail.com');
        $user2->addArtist($this->getReference(ArtistFixture::AURORA));
        $user2->setIsAdmin(false);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setFirstname('Hector');
        $user3->setLastname('Junior');
        $user3->setMailU('hectorejunior@gmail.com');
        $user3->addArtist($this->getReference(ArtistFixture::ZIAK));
        $user3->setIsAdmin(false);
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
