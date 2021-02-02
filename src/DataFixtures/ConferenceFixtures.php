<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ConferenceFixtures extends Fixture
{

    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        $lisbon = new Conference();
        $lisbon->setCity('Lisbon');
        $lisbon->setYear('2020');
        $lisbon->setIsInternational(true);
        $manager->persist($lisbon);

        $london = new Conference();
        $london->setCity('London');
        $london->setYear('2021');
        $london->setIsInternational(false);
        $manager->persist($london);

        $rotterdamn = new Conference();
        $rotterdamn->setCity('Rotterdamn');
        $rotterdamn->setYear('2022');
        $rotterdamn->setIsInternational(true);
        $manager->persist($rotterdamn);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->encoderFactory->getEncoder(Admin::class)->encodePassword('admin', null));
        $manager->persist($admin);
         
        $manager->flush();
    }

}
