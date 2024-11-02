<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomersType;
use App\Repository\CustomersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/customers')]
class CustomersController extends AbstractController {

    private $manager;
    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route(name: 'app_customers_index', methods: ['GET'])]
    public function index(CustomersRepository $customersRepository): Response
    {
        return $this->render('customers/index.html.twig', [
            'customers' => $customersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_customers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response {
        $customer = new Customers();
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('images') as $imageForm) {
                $imageFile = $imageForm->get('image')->getData();

                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                    try {
                        $imageFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // handle exception if something happens during file upload
                    }

                    $image = $imageForm->getData();
                    $image->setUrl('/uploads/images/'.$newFilename);
                    $customer->addImage($image);

                    // Appeler explicitement persist sur chaque entité Image
                    $this->manager->persist($image);
                }
            }

            $this->manager->persist($customer);
            $this->manager->flush();

            return $this->redirectToRoute('app_customers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customers/new.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_customers_show', methods: ['GET'])]
    public function show(Customers $customer): Response
    {
        return $this->render('customers/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_customers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customers $customer, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('images') as $imageForm) {
                $imageFile = $imageForm->get('image')->getData();

                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                    try {
                        $imageFile->move(
                            $this->getParameter('images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // handle exception if something happens during file upload
                    }

                    // Supprimer l'ancien fichier si nécessaire
                    if ($imageForm->getData()->getUrl()) {
                        $oldFilePath = $this->getParameter('images_directory').'/'.basename($imageForm->getData()->getUrl());
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $image = $imageForm->getData();
                    $image->setUrl('/uploads/images/'.$newFilename);
                    $customer->addImage($image);

                    // Appeler explicitement persist sur chaque entité Image
                    $this->manager->persist($image);
                }
            }

            $this->manager->flush();

            return $this->redirectToRoute('app_customers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customers/edit.html.twig', [
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_customers_delete', methods: ['POST'])]
    public function delete(Request $request, Customers $customer): Response {

        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            // Supprimer les images associées
            foreach ($customer->getImages() as $image) {
                $oldFilePath = $this->getParameter('images_directory').'/'.basename($image->getUrl());
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
                $this->manager->remove($image);
            }

            $this->manager->remove($customer);
            $this->manager->flush();
        }

        return $this->redirectToRoute('app_customers_index', [], Response::HTTP_SEE_OTHER);
    }
}
