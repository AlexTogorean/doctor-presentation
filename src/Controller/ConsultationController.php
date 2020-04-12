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
     * @Route("/consultanta-on-line", name="app_consultation")
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

            $consultation = new Consultation();
            $form = $this->createForm(ConsultationType::class, $consultation);

            return $this->render('consultation/index.html.twig', [
                'form' => $form->createView(),
                'submitted' => true
            ]);
        }

        return $this->render('consultation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
