<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Page;
use App\Entity\Contact;
use App\Entity\Highlight;
use App\Entity\Illustration;
use Faker\ORM\Doctrine\Populator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $generator = Factory::create('fr_FR');

        // On passe le Manager de Doctrine à Faker !
        $populator = new Populator($generator, $manager);

        $populator->addEntity('App\Entity\Contact', 5, array(
            'firstName' => function() use ($generator) {return $generator->firstName(); },
            'lastName' => function() use ($generator) {return $generator->lastName(); },
            'email' => function() use ($generator) { return$generator->email(); },
            'message' => function() use ($generator) { return$generator->text($maxNbChars = 200); },
        ));
  
        $populator->addEntity('App\Entity\Highlight', 7, array(
            'title' => function() use ($generator) { return $generator->sentence($nbWords = 6, $variableNbWords = true); },
            'content' => function() use ($generator) { return $generator->text($maxNbChars = 200); },
            'createdAt' => function() use ($generator) { return $generator->dateTimeBetween($startDate = '-30 years', $endDate = 'now'); },
        ));

        $populator->addEntity('App\Entity\Illustration', 10, array(
            'title' => function() use ($generator) { return $generator->word(); },
            'createdAt' => function() use ($generator) { return $generator->dateTimeBetween($startDate = '-30 years', $endDate = 'now'); },
          ));

          $populator->addEntity('App\Entity\Page', 3, array(
            'title' => function() use ($generator) { return $generator->sentence($nbWords = 6, $variableNbWords = true); },
            'content' => function() use ($generator) { return $generator->text($maxNbChars = 200); },
            'createdAt' => function() use ($generator) { return $generator->dateTimeBetween($startDate = '-30 years', $endDate = 'now'); },
          ));

          $populator->addEntity('App\Entity\User', 10, array(
            'email' => function() use ($generator) { return $generator->email(); },
            'password' => function() use ($generator) { return $generator->password(); },
          ));

        $populator->execute();

        $manager->flush();
    }
}
