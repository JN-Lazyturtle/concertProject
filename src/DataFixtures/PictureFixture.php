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
        $auroraPic->setUrl('http://riffmagazine.com/wp-content/uploads/2019/02/IMG_8138.jpg');
        $manager->persist($auroraPic);

        $ziakPic = new Picture();
        $ziakPic->setNameP('Ziak - en concert');
        $ziakPic->setUrl('https://www.tasteofindie.com/wp-content/uploads/2021/12/IMG_3644-1500x1000.jpg');
        $manager->persist($ziakPic);

        $linkinparkPic = new Picture();
        $linkinparkPic->setNameP('Linkin Park - en concert');
        $linkinparkPic->setUrl('https://www.parismatch.com/lmnr/f/webp/r/960,640,FFFFFF,forcex,center-middle/img/var/pm/public/media/image/2022/03/03/17/Linkin-Park-remonte-sur-scene-pour-honorer-Chester-Bennington.jpg?VersionId=JYPc79PRzfYB3munFgz1OAQHci13pLpM');
        $manager->persist($linkinparkPic);

        $manager->flush();

        $this->addReference(self::AURORA_PICTURE, $auroraPic);
        $this->addReference(self::ZIAK_PICTURE, $ziakPic);
        $this->addReference(self::LINKINPARK_PICTURE, $linkinparkPic);
    }
}
