<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArtistFixture extends Fixture implements DependentFixtureInterface
{
    public const AURORA = 'aurora';
    public const LINKIN_PARK = 'linkinPark';
    public const ZIAK = 'ziak';

    public function load(ObjectManager $manager): void
    {
        $aurora = new Artist();
        $aurora->setNameA('Aurora');
        $aurora->setContactA('aurora@gmail.com');
        $aurora->setSummaryA('Aurora Aksnes, known mononymously as Aurora, is a Norwegian singer, songwriter and record producer. Born in Stavanger and raised in the towns of Høle and Os, she began writing her first songs and learning dance at the age of six.');
        $aurora->addMusicStyle($this->getReference(MusicStyleFixture::POP));
        $aurora->setPictureA($this->getReference(PictureFixture::AURORA_PICTURE));
        $manager->persist($aurora);

        $linkinPark = new Artist();
        $linkinPark->setNameA('Linkin Park');
        $linkinPark->setContactA('linkinpark@gmail.com');
        $linkinPark->setSummaryA("Linkin Park is an American rock band from Agoura Hills, California. The band's current lineup comprises vocalist/rhythm guitarist/keyboardist Mike Shinoda, lead guitarist Brad Delson, bassist Dave Farrell, DJ/turntablist Joe Hahn and drummer Rob Bourdon, all of whom are founding members.");
        $linkinPark->addMusicStyle($this->getReference(MusicStyleFixture::ROCK));
        $linkinPark->setPictureA($this->getReference(PictureFixture::LINKINPARK_PICTURE));
        $manager->persist($linkinPark);

        $ziak = new Artist();
        $ziak->setNameA('Ziak');
        $ziak->setContactA('ziak@gmail.com');
        $ziak->setSummaryA("Ziak a pour particularité de toujours apparaitre masqué et de ne divulguer aucune information sur son identité, créant ainsi un personnage très singulier. Il est l'un des principaux représentants de la Drill française avec Gazo, Freeze Corleone ou Ashe 223.");
        $ziak->addMusicStyle($this->getReference(MusicStyleFixture::RAP));
        $ziak->setPictureA($this->getReference(PictureFixture::ZIAK_PICTURE));
        $manager->persist($ziak);

        $manager->flush();

        $this->addReference(self::AURORA, $aurora);
        $this->addReference(self::LINKIN_PARK, $linkinPark);
        $this->addReference(self::ZIAK, $ziak);
    }

    public function getDependencies(): array
    {
        return [
            MusicStyleFixture::class,
            PictureFixture::class
        ];
    }
}
