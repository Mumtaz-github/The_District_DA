<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        // Define the context variables
        $context = [
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'foo',
            'custom_message' => 'Bonjour les gens !!!',
            'recipient_email' => 'ryan@example.com', // Adjusted variable name
        ];

        // Create the email
        $email = (new TemplatedEmail())
        ->from('hello@example.com')
        ->to('ryan@example.com')
        ->subject('Test Email')
        ->text('This is a test email.');
    
    $mailer->send($email);
    

        // Optionally add attachments if needed
        // $email->addPart(new DataPart(new File('assets/images/Collins.pdf'), 'Collins.pdf'));

        // Optionally add inline images if needed
        // $email->addPart((new DataPart(fopen('/path/to/images/logo.png', 'r'), 'logo', 'image/png'))->asInline());
        // $email->addPart((new DataPart(new File('/path/to/images/signature.gif'), 'footer-signature', 'image/gif'))->asInline());

        // Send the email
      

        // Return a Response object to indicate success
        return new Response('Email sent successfully!');
    }
}
