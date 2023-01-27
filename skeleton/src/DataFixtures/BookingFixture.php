<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingFixture extends Fixture implements DependentFixtureInterface
{
    public const BOOKING1 = 'booking1';
    public const BOOKING2 = 'booking2';
    public const BOOKING3 = 'booking3';

    public function load(ObjectManager $manager): void
    {
        $booking1 = new Booking();
        $booking1->setUser($this->getReference(UserFixture::USER1));
        $booking1->setConcert($this->getReference(ConcertFixtures::CONCERT2));
        $booking1->setNbTicket(4);
        $manager->persist($booking1);

        $booking2 = new Booking();
        $booking2->setUser($this->getReference(UserFixture::USER2));
        $booking2->setConcert($this->getReference(ConcertFixtures::CONCERT3));
        $booking2->setNbTicket(2);
        $manager->persist($booking2);

        $booking3 = new Booking();
        $booking3->setUser($this->getReference(UserFixture::USER1));
        $booking3->setConcert($this->getReference(ConcertFixtures::CONCERT3));
        $booking3->setNbTicket(1);
        $manager->persist($booking3);

        $manager->flush();

        $this->addReference(self::BOOKING1, $booking1);
        $this->addReference(self::BOOKING2, $booking2);
        $this->addReference(self::BOOKING3, $booking3);
    }

    public function getDependencies()
    {
        return [
            UserFixture::class,
            ConcertFixtures::class
        ];
    }
}
