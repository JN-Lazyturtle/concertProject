<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use App\Entity\ConcertHall;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    public const CONCERT1 = 'concert1';
    public const CONCERT2 = 'concert2';
    public const CONCERT3 = 'concert3';

    public function load(ObjectManager $manager): void
    {
        $concert1 = new Concert();
        $concert1->addArtist($this->getReference(ArtistFixture::AURORA));
        $concert1->setDateC(new DateTime('2023-01-30 20:00:00'));
        $concert1->setConcertHall($this->getReference(ConcertHallFixture::PETIOLE));
        $manager->persist($concert1);

        $concert2 = new Concert();
        $concert2->addArtist($this->getReference(ArtistFixture::ZIAK));
        $concert2->setDateC(new DateTime('2023-01-30 22:00:00'));
        $concert2->setConcertHall($this->getReference(ConcertHallFixture::SCALAIRE));
        $manager->persist($concert2);

        $concert3 = new Concert();
        $concert3->addArtist($this->getReference(ArtistFixture::LINKIN_PARK));
        $concert3->setDateC(new DateTime('2023-03-10 21:30:00'));
        $concert3->setConcertHall($this->getReference(ConcertHallFixture::SCALAIRE));
        $manager->persist($concert3);

        $manager->flush();

        $this->addReference(self::CONCERT1, $concert1);
        $this->addReference(self::CONCERT2, $concert2);
        $this->addReference(self::CONCERT3, $concert3);
    }

    public function getDependencies()
    {
        return [
            ArtistFixture::class,
            ConcertHallFixture::class
        ];
    }
}
