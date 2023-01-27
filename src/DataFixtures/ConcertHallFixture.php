<?php

namespace App\DataFixtures;

use App\Entity\ConcertHall;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertHallFixture extends Fixture
{
    public const ENTROPIE = 'entropie';
    public const SCALAIRE = 'scalaire';
    public const PETIOLE = 'petiole';

    public function load(ObjectManager $manager): void
    {
        $entropie = new ConcertHall();
        $entropie->setNameH('Entropie');
        $entropie->setCapacity(30);
        $entropie->setRenovationStartDate(new DateTime('2023-01-10 10:00:00'));
        $entropie->setRenovationEndDate(new DateTime('2023-03-10 10:00:00'));
        $manager->persist($entropie);

        $scalaire = new ConcertHall();
        $scalaire->setNameH('Scalaire');
        $scalaire->setCapacity(1500);
        $manager->persist($scalaire);

        $petiole = new ConcertHall();
        $petiole->setNameH('Petiole');
        $petiole->setCapacity(600);
        $manager->persist($petiole);

        $manager->flush();

        $this->addReference(self::ENTROPIE, $entropie);
        $this->addReference(self::SCALAIRE, $scalaire);
        $this->addReference(self::PETIOLE, $petiole);
    }
}
