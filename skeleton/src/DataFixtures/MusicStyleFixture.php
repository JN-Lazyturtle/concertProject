<?php

namespace App\DataFixtures;

use App\Entity\MusicStyle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MusicStyleFixture extends Fixture
{

    public const POP = 'pop';
    public const ROCK = 'rock';
    public const RAP = 'rap';

    public function load(ObjectManager $manager): void
    {
        $pop = new MusicStyle();
        $pop->setNameMS('Pop');
        $manager->persist($pop);

        $rock = new MusicStyle();
        $rock->setNameMS('Rock');
        $manager->persist($rock);

        $rap = new MusicStyle();
        $rap->setNameMS('Rap');
        $manager->persist($rap);

        $manager->flush();

        $this->addReference(self::RAP, $rap);
        $this->addReference(self::ROCK, $rock);
        $this->addReference(self::POP, $pop);
    }
}
