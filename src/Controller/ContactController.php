<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();

            dump($contactFormData);

            $message = (new \Swift_Message('You got mail'))
                ->setFrom($contactFormData['email'])
                ->setTo('andronie27@mailinator.com')
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                );
            $mailer->send($message);

            $this->addFlash('success','message was sent');
            $this->redirectToRoute('contact');
        }

       return $this->render('contact/contact.html.twig',[
            'our_form'=>$form->createView()
        ]);

    }
}
