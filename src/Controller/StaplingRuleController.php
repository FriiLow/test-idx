<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StaplingRuleController extends AbstractController
{
    #[Route('/stapling/rule', name: 'app_stapling_rule')]
    public function index(): Response
    {
        return $this->render('stapling_rule/index.html.twig', [
            'controller_name' => 'StaplingRuleController',
        ]);
    }

    #[Route('/rule/new', name: 'app_rule_new')]
    public function new(Request $request): Response
    {
        $rule = new StaplingRule();

        // 👇 Ici on simule une config venant de la relation
        // En vrai : $rule->getStaplingConfig()?->getContainer()?->getConfig()
        $config = [
            'optional' => 'checkbox',
            'visible' => 'checkbox',
        ];

        $form = $this->createForm(StaplingRuleType::class, $rule, [
            'config' => $config,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // persist + flush ici
        }

        return $this->render('rule/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
