<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkillController extends AbstractController {

    private $manager;
    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('/skill', name: 'app_skill')]
    public function index(): Response
    {
        return $this->render('skill/index.html.twig', [
            'controller_name' => 'SkillController',
        ]);
    }
    #[Route('/skill/new', name: 'app_skill_new')]
    public function newSkill(Request $request, Skill $skill) : Response {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($skill);
            $manager->flush();

            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('skill/new.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }
    #[Route('/skill/{id}', name: 'app_skill_show')]
    public function showSkill(Skill $skill): Response {
        return $this->render('skill/show.html.twig', [
            'skill' => $skill,
        ]);
    }
    #[Route('/skill/{id}/edit', name: 'app_skill_edit')]
    public function editSkill(Request $request, Skill $skill, $manager): Response {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($skill);
            $manager->flush();

            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('skill/edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }
    #[Route('/skill/{id}', name: 'app_skill_delete', methods: ['POST'])]
    public function deleteSkill(Skill $skill, $manager): Response {
        $manager->remove($skill);
        $manager->flush();

        return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
    }
}
