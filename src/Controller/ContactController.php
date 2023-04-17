<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        // 3.Création de l'instance de classe "contact" dans le contrôller
        $contact = new Contact();
        // 4.création de l'objet du formulaire
        $form = $this->createForm(ContactType::class, $contact);

        // 7.recupérer les données
        $form->handleRequest($request);


       if ($form->isSubmitted() && $form->isValid()) {
           $contact = $form->getData();

        // 8. enregistrer les données dans la BDD
        //$entityManager->$this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();


        // 5.envoyer $form au twig
    }
    return $this->render('contact/index.html.twig', [
        'controller_name' => 'ContactController',
        'form'=> $form->CreateView()

    ]);
}


        /**
        * @Route("/contacts", name="contact_list")
        */
        public function listContacts()
        {
            $repository = $this->getDoctrine()->getRepository(Contact::class);
            $contacts = $repository->findAll();
 
 
            return $this->render('contact/list.html.twig', [
                'contacts' => $contacts,
            ]);
        }
 
/**
    * @Route("/contact/edit/{id}", name="contact_edit", requirements={"id"="\d+"})
    */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
 
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
 
 
            return $this->redirectToRoute('contact_list');
        }
 
 
        return $this->render('contact/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 
 
    /**
     * @Route("/contact/delete/{id}", name="contact_delete", requirements={"id"="\d+"})
     */
    public function delete(Contact $contact): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();
 
 
        return $this->redirectToRoute('contact_list');
    }
   
 

}