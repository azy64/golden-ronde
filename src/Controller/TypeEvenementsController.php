<?php

namespace App\Controller;

use App\Entity\TypeEvenements;
use App\Form\TypeEvenementsType;
use App\Repository\TypeEvenementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/type/evenements")
 * 
 */
class TypeEvenementsController extends AbstractController
{
    /**
     * @Route("/", name="app_type_evenements_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(TypeEvenementsRepository $typeEvenementsRepository): Response
    {
        return $this->render('type_evenements/index.html.twig', [
            'type_evenements' => $typeEvenementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_type_evenements_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, TypeEvenementsRepository $typeEvenementsRepository): Response
    {
        $typeEvenement = new TypeEvenements();
        $form = $this->createForm(TypeEvenementsType::class, $typeEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeEvenementsRepository->add($typeEvenement, true);

            return $this->redirectToRoute('app_type_evenements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_evenements/new.html.twig', [
            'type_evenement' => $typeEvenement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="app_type_evenements_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(TypeEvenements $typeEvenement): Response
    {
        return $this->render('type_evenements/show.html.twig', [
            'type_evenement' => $typeEvenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_evenements_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, TypeEvenements $typeEvenement, TypeEvenementsRepository $typeEvenementsRepository): Response
    {
        $form = $this->createForm(TypeEvenementsType::class, $typeEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeEvenementsRepository->add($typeEvenement, true);

            return $this->redirectToRoute('app_type_evenements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_evenements/edit.html.twig', [
            'type_evenement' => $typeEvenement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_evenements_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, TypeEvenements $typeEvenement, TypeEvenementsRepository $typeEvenementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEvenement->getId(), $request->request->get('_token'))) {
            $typeEvenementsRepository->remove($typeEvenement, true);
        }

        return $this->redirectToRoute('app_type_evenements_index', [], Response::HTTP_SEE_OTHER);
    }
    
    /**
     * @Route("/tout", name="type_evenements", methods={"GET"})
     */
    public function allTypeEvenements(TypeEvenementsRepository $typeEvenementsRepository): Response
    {
        $typeEvenements = $typeEvenementsRepository->findAll();
        $data = [];
        foreach ($typeEvenements as $typeEvenement) {
            $data[] = $typeEvenement->getLibelle();
        }
        return $this->json($data);
    }
}
