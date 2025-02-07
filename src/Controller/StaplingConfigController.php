<?php

namespace App\Controller;

use App\Entity\StaplingConfig;
use App\Form\StaplingConfigType;
use App\Repository\StaplingConfigRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/stapling/config')]
final class StaplingConfigController extends AbstractController
{
    #[Route(name: 'app_stapling_config_index', methods: ['GET'])]
    public function index(StaplingConfigRepository $staplingConfigRepository): Response
    {
        return $this->render('stapling_config/index.html.twig', [
            'stapling_configs' => $staplingConfigRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stapling_config_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $staplingConfig = new StaplingConfig();
        $form = $this->createForm(StaplingConfigType::class, $staplingConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($staplingConfig);
            $entityManager->flush();

            return $this->redirectToRoute('app_stapling_config_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stapling_config/new.html.twig', [
            'stapling_config' => $staplingConfig,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stapling_config_show', methods: ['GET'])]
    public function show(StaplingConfig $staplingConfig): Response
    {
        return $this->render('stapling_config/show.html.twig', [
            'stapling_config' => $staplingConfig,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stapling_config_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StaplingConfig $staplingConfig, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StaplingConfigType::class, $staplingConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_stapling_config_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stapling_config/edit.html.twig', [
            'stapling_config' => $staplingConfig,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stapling_config_delete', methods: ['POST'])]
    public function delete(Request $request, StaplingConfig $staplingConfig, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$staplingConfig->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($staplingConfig);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_stapling_config_index', [], Response::HTTP_SEE_OTHER);
    }
}
