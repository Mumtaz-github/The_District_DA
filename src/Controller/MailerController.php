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
        $email = (new TemplatedEmail())
            ->from('hello@example.com')
            ->to(new Address('ryan@example.com'))
            ->subject('Time for Symfony Mailer!')
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
                'custom_message' => 'Bonjour les gens !!!',
            ]);

        // Add attachments
        $email->addPart(new DataPart(new File('assets/images/Collins.pdf')));
        //$email->addPart(new DataPart(new File('/path/to/documents/privacy.pdf'), 'Privacy Policy'));
        //$email->addPart(new DataPart(new File('/path/to/documents/contract.doc'), 'Contract', 'application/msword'));

        // Add inline images (uncomment if needed)
        // $email->addPart((new DataPart(fopen('/path/to/images/logo.png', 'r'), 'logo', 'image/png'))->asInline());
        // $email->addPart((new DataPart(new File('/path/to/images/signature.gif'), 'footer-signature', 'image/gif'))->asInline());

        // Send the email
        $mailer->send($email);

        // Return a Response object to indicate success
        return new Response('Email sent successfully!');
    }
}
    
    //$email->addPart((new DataPart(fopen('/path/to/images/logo.png', 'r'), 'logo', 'image/png'))->asInline());
    //$email->addPart((new DataPart(new File('/path/to/images/signature.gif'), 'footer-signature', 'image/gif'))->asInline());
        
      
