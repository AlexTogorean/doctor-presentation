<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Form\ConsultationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConsultationController extends AbstractController
{
    /**
     * @Route("/consultatie-on-line", name="app_consultation")
     */
    public function index(Request $request)
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('app_consultation_confirmation');
        }

        return $this->render('consultation/index.html.twig', [
            'controller_name' => 'ConsultationController',
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/confirmare-consultatie-on-line", name="app_consultation_confirmation")
     */
    public function confirmation(Request $request)
    {
        return $this->render('consultation/confirmation.html.twig', [
            'controller_name' => 'ConsultationController',
        ]);
    }
}
