<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Video;

class InheritanceEntitlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i=1; $i<=2; $i++)
        {
            $author = new Author;
            $author->setName('Author name' . $i);
            $manager->persist($author);

            for ($j=1; $j<=3; $j++)
            {
                $pdf = new Pdf;
                $pdf->setFilename('pdf name of user ' . $i);
                $pdf->setDescription('pdf description of user ' . $i);
                $pdf->setSize(5454);
                $pdf->setOrientation('portrait');
                $pdf->setPagesNumber(123);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($k=1; $k<=2; $k++)
            {
                $video = new Video;
                $video->setFilename('vidoe name of user ' . $i);
            }

        }

        $manager->flush();
    }
}
