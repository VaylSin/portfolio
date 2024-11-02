<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Form\TestimonialType;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testimonials')]
final class TestimonialController extends AbstractController {

    private $manager;
    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route(name: 'app_testimonial_index', methods: ['GET'])]
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        return $this->render('testimonial/index.html.twig', [
            'testimonials' => $testimonialRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testimonial_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $testimonial = new Testimonial();
        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($testimonial);
            $this->manager->flush();

            return $this->redirectToRoute('app_testimonial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testimonial/new.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimonial_show', methods: ['GET'])]
    public function show(Testimonial $testimonial): Response
    {
        return $this->render('testimonial/show.html.twig', [
            'testimonial' => $testimonial,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testimonial_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Testimonial $testimonial): Response
    {
        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('app_testimonial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testimonial/edit.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimonial_delete', methods: ['POST'])]
    public function delete(Request $request, Testimonial $testimonial): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testimonial->getId(), $request->getPayload()->getString('_token'))) {
            $this->manager->remove($testimonial);
            $this->manager->flush();
        }

        return $this->redirectToRoute('app_testimonial_index', [], Response::HTTP_SEE_OTHER);
    }
}
