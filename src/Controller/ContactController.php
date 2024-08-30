<?php
/*
namespace App\Controller;

use App\Entity\Contact;
use App\Form\DemoFormType;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //on crée une instance de Contact
            $message = new Contact();
            // Traitement des données du formulaire
            $data = $form->getData();
            //on stocke les données récupérées dans la variable $message
            $message = $data;

            $entityManager->persist($message);
            $entityManager->flush();

            // Redirection vers accueil
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
//            'form' => $form->createView(),
              'form' => $form
        ]);
    }
} */

/*the above already work well with database mariaDB */

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Créer une nouvelle instance de Contact
            $message = new Contact();
            $data = $form->getData();
            $message = $data;

            // Envoi de l'email après validation du formulaire
            $email = (new TemplatedEmail())
            ->from($data->getEmail())  // Adresse email de l'utilisateur
            ->to('youremail@example.com') // Remplacez par votre adresse email
            ->subject($data->getObjet()) // Sujet du formulaire
            ->htmlTemplate('emails/contact_email.html.twig') // Template Twig
            ->context([
                'userEmail' => $data->getEmail(), // Utilisez une clé différente pour l'email de l'utilisateur
                'subject' => $data->getObjet(), // Sujet du formulaire
                'message' => $data->getMessage(), // Message du formulaire
            ]);
        
        $mailer->send($email);
        

            // Persister les données dans la base de données
            $entityManager->persist($message);
            $entityManager->flush();

            // Redirection vers la page d'accueil après soumission du formulaire
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

