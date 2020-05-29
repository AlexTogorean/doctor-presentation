<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Form\ConsultationType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ConsultationController extends AbstractController
{
    /**
     * @Route("/consultanta-on-line", name="app_consultation")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $consultation = $form->getData();
            $entityManager->persist($consultation);
            $entityManager->flush();

            $email = (new TemplatedEmail())
                ->from($this->getParameter('mail_sender'))
                ->to($consultation->getEmail())
                ->subject('Consultație online cu Dr. Monica Burlacu')
                ->htmlTemplate('emails/consultation-created.html.twig');
            $mailer->send($email);

            $email = (new TemplatedEmail())
                ->from($this->getParameter('mail_sender'))
                ->to($this->getParameter('mail_doctor'))
                ->subject('Consultație online înregistrată')
                ->htmlTemplate('emails/consultation-created-doctor.html.twig');
            $mailer->send($email);

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
