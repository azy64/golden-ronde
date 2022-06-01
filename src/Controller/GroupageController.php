<?php

namespace App\Controller;

use App\Entity\Groupage;
use App\Form\GroupageType;
use App\Repository\GroupageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/groupage")
 * @IsGranted("ROLE_ADMIN")
 */
class GroupageController extends AbstractController
{
    /**
     * @Route("/", name="app_groupage_index", methods={"GET"})
     */
    public function index(GroupageRepository $groupageRepository): Response
    {
        return $this->render('groupage/index.html.twig', [
            'groupages' => $groupageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_groupage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GroupageRepository $groupageRepository): Response
    {
        $groupage = new Groupage();
        $form = $this->createForm(GroupageType::class, $groupage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupageRepository->add($groupage, true);

            return $this->redirectToRoute('app_groupage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupage/new.html.twig', [
            'groupage' => $groupage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_groupage_show", methods={"GET"})
     */
    public function show(Groupage $groupage): Response
    {
        return $this->render('groupage/show.html.twig', [
            'groupage' => $groupage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_groupage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Groupage $groupage, GroupageRepository $groupageRepository): Response
    {
        $form = $this->createForm(GroupageType::class, $groupage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupageRepository->add($groupage, true);

            return $this->redirectToRoute('app_groupage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupage/edit.html.twig', [
            'groupage' => $groupage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_groupage_delete", methods={"POST"})
     */
    public function delete(Request $request, Groupage $groupage, GroupageRepository $groupageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupage->getId(), $request->request->get('_token'))) {
            $groupageRepository->remove($groupage, true);
        }

        return $this->redirectToRoute('app_groupage_index', [], Response::HTTP_SEE_OTHER);
    }
}
