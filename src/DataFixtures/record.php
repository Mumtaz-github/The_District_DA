<?php

// src/DataFixtures/record.php

namespace App\DataFixtures;


use App\Entity\Artist; // Import the Artist entity class
use App\Entity\Disc; // Import the Disc entity class
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class record implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artist = array(
            array(
                'artist_id' => 1,
                'artist_name' => 'The Beatles',
                'artist_url' => 'https://www.thebeatles.com'
            ),
            array(
                'artist_id' => 2,
                'artist_name' => 'The Rolling Stones',
                'artist_url' => 'https://www.rollingstones.com'
            ),
            array(
                'artist_id' => 3,
                'artist_name' => 'Queen',
                'artist_url' => 'https://www.queenonline.com'
            ),
            array(
                'artist_id' => 4,
                'aritist_name' => 'Neil Young',
                'artist_url' => 'https://neilyoung.warnerartists.net'
            ),

        );

        $disc = array(
            array(
                'disc_title' => 'Sgt. Pepper\'s Lonely Hearts Club Band',
                'disc_label' => 'Parlophone',
                'disc_picture' => 'https://example.com/sgt-pepper.jpg',
                'artist_id' => 1
            ),
            array(
                'disc_title' => 'Exile on Main St.',
                'disc_label' => 'Rolling Stones Records',
                'disc_picture' => 'https://example.com/exile.jpg',
                'artist_id' => 2
            ),
            array(
                'disc_title' => 'A Night at the Opera',
                'disc_label' => 'EMI',
                'disc_picture' => 'https://example.com/night-at-the-opera.jpg',
                'artist_id' => 3
            ),

            array(
                'disc_title' => 'Harvest Moon',
                'disc_label' => 'Harvest',
                'disc_picture' => 'https://shutterstock.com/fr/search/neil-young',
                'artist_id' => 4
            ),

          
        );

        // Create and persist the artist and disc entities
      // ...

foreach ($artist as $data) {
    $artistEntity = new Artist();
    // $artistEntity->setId($data['artist_id']); // Set the id property
    $artistEntity->setName($data['artist_name']); // Use the setName method
    $artistEntity->setUrl($data['artist_url']); // Use the setUrl method
    $manager->persist($artistEntity);
}

foreach ($disc as $data) {
    $discEntity = new Disc();
    $discEntity->setTitle($data['disc_title']); // Use the setTitle method
    $discEntity->setLabel($data['disc_label']); // Use the setLabel method
    $discEntity->setPicture($data['disc_picture']); // Use the setPicture method
    $discEntity->setArtist($manager->getRepository(Artist::class)->find($data['artist_id']));
    $manager->persist($discEntity);
}

$manager->flush();
    }
}