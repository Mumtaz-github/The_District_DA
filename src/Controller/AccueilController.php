<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\DiscRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
   

    private $artistRepo;
    private $discRepo;
    private $em;

    public function __construct(ArtistRepository $artistRepo, DiscRepository $discRepo, EntityManagerInterface $em)
    {
        $this->artistRepo = $artistRepo;
        $this->discRepo = $discRepo;
        $this->em = $em;

    }

    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {

        //on appelle la fonction `findAll()` du repository de la classe `Artist` afin de récupérer tous les artists de la base de données;
          $artistes = $this->artistRepo->findAll();
         $artistes = $this->artistRepo->getSomeArtists("Neil"); #replaced get findAll(); for getSomeArtist("Neil");
         //on teste le contenu de la variable $artistes : dd() veut dire Dump and Die
         dd($artistes);
       return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            //on va envoyer à la vue notre variable qui stocke un tableau d'objets $artistes (c'est-à-dire tous les artistes trouvés dans la base de données)
            'artistes' => $artistes
           
        ]);
    
    }

}