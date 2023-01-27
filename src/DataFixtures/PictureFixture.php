<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixture extends Fixture
{
    public const AURORA_PICTURE = 'auroraPic';
    public const ZIAK_PICTURE = 'ziakPic';
    public const LINKINPARK_PICTURE = 'linkinparkPic';

    public function load(ObjectManager $manager): void
    {
        $auroraPic = new Picture();
        $auroraPic->setNameP('Aurora - Cure For Me');
        $auroraPic->setUrl('https://static.wikia.nocookie.net/aurora-aksnes/images/d/d4/CureForMe.jpg/revision/latest/scale-to-width-down/1000?cb=20220924212116');
        $manager->persist($auroraPic);

        $ziakPic = new Picture();
        $ziakPic->setNameP('Ziak - en concert');
        $ziakPic->setUrl('https://www.tasteofindie.com/wp-content/uploads/2021/12/IMG_3644-1500x1000.jpg');
        $manager->persist($ziakPic);

        $linkinparkPic = new Picture();
        $linkinparkPic->setNameP('Linkin Park - poster');
        $linkinparkPic->setUrl('https://m.media-amazon.com/images/I/71yF0tmeY3L._AC_SL1500_.jpg');
        $manager->persist($linkinparkPic);

        $manager->flush();

        $this->addReference(self::AURORA_PICTURE, $auroraPic);
        $this->addReference(self::ZIAK_PICTURE, $ziakPic);
        $this->addReference(self::LINKINPARK_PICTURE, $linkinparkPic);
    }
}
