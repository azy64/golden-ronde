<?php

namespace App\Controller;

use App\Entity\Pointaux;
use App\Entity\Site;
use App\Form\PointauxType;
use App\Repository\PointauxRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/pointaux")
 * @isGranted("ROLE_ADMIN")
 */
class PointauxController extends AbstractController
{
    /**
     * @Route("/", name="app_pointaux_index", methods={"GET"})
     */
    public function index(PointauxRepository $pointauxRepository): Response
    {
        return $this->render('pointaux/index.html.twig', [
            'pointauxes' => $pointauxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pointaux_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PointauxRepository $pointauxRepository): Response
    {
        $pointaux = new Pointaux();
        $form = $this->createForm(PointauxType::class, $pointaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pointauxRepository->add($pointaux, true);

            return $this->redirectToRoute('app_pointaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pointaux/new.html.twig', [
            'pointaux' => $pointaux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/show", name="app_pointaux_show", methods={"GET"})
     */
    public function show(Pointaux $pointaux): Response
    {
        return $this->render('pointaux/show.html.twig', [
            'pointaux' => $pointaux,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pointaux_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pointaux $pointaux, PointauxRepository $pointauxRepository): Response
    {
        $form = $this->createForm(PointauxType::class, $pointaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pointauxRepository->add($pointaux, true);

            return $this->redirectToRoute('app_pointaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pointaux/edit.html.twig', [
            'pointaux' => $pointaux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app_pointaux_delete", methods={"POST"})
     */
    public function delete(Request $request, Pointaux $pointaux, PointauxRepository $pointauxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointaux->getId(), $request->request->get('_token'))) {
            $pointauxRepository->remove($pointaux, true);
        }

        return $this->redirectToRoute('app_pointaux_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/site-pointaux/{id}", name="app_pointaux_get", methods={"GET"})
     */
    public function getPointauxFromSite(Request $request,$id, PointauxRepository $point_r): Response
    {
        $pointauxes = $point_r->findBy(['site'=>$id]);
        $tab = [];
        foreach ($pointauxes as $pointaux) {
            $tab[] = $pointaux->getLibelle();
        }

        return $this->json($tab);
    }
}
