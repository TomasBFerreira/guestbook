<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Faker\Generator;
use App\Entity\Comment;
use App\Entity\Conference;

class FakerFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();
        $conferenceRepository = $manager->getRepository(Conference:: class);
        $conferences = $conferenceRepository->findAll();
        foreach($conferences as $conference)
        {
            $r = rand(0, 10);
            for($i = 0; $i < $r; $i++){
                $comment = new Comment();
                $comment->setConference($conference)->setAuthor($faker->name)->setEmail($faker->email)
                        ->setText($faker->realText($maxNbChars = 200, $indexSize = 2));
                $manager->persist($comment);
            }
            
        }
        $manager->flush();
    }

}
