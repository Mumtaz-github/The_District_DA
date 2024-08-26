<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Disc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /*  $artistData = json_decode(file_get_contents(__DIR__ . '/artist_data.json'), true);
        $discData = json_decode(file_get_contents(__DIR__ . '/disc_data.json'), true);

        $artistRepo = $manager->getRepository(Artist::class);

        foreach ($artistData as $art) {
            $artistDB = new Artist();
            $artistDB
                ->setName($art['artist_name'])
                ->setUrl($art['artist_url']);

            $manager->persist($artistDB);
        }

        $manager->flush();

        foreach ($discData as $d) {
            $discDB = new Disc();
            $discDB
                ->setTitle($d['disc_title'])
                ->setLabel($d['disc_label'])
                ->setPicture($d['disc_picture']);
            $artist = $artistRepo->find($d['artist_id']);
            $discDB->setArtist($artist);
            $manager->persist($discDB);
        }

        $manager->flush();*/
        $artist = array(
            array(
                'id' => 1,
                'name' => 'The Beatles',
                'url' => 'https://www.thebeatles.com'
            ),
            array(
                'id' => 2,
                'name' => 'The Rolling Stones',
                'url' => 'https://www.rollingstones.com'
            ),
            array(
                'id' => 3,
                'name' => 'Queen',
                'url' => 'https://www.queenonline.com'
            ),
            array(
                'id' => 4,
                'name' => 'Neil Young',
                'url' => 'https://neilyoung.warnerartists.net'
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
            //  $artistEntity->setId($data['id']); // Set the id property
            $artistEntity->setName($data['name']); // Use the setName method
            $artistEntity->setUrl($data['url']); // Use the setUrl method
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
