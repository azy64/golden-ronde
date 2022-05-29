<?php

namespace App\Controller;

use App\Entity\Evenements;
use App\Entity\Groupage;
use App\Entity\LaRonde;
use App\Entity\Pointaux;
use App\Entity\Site;
use App\Entity\TypeEvenements;
use App\Form\LaRondeType;
use App\Repository\LaRondeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/la/ronde")
 * @IsGranted("ROLE_USER")
 */
class LaRondeController extends AbstractController
{
    /**
     * @Route("/", name="app_la_ronde_index", methods={"GET"})
     */
    public function index(LaRondeRepository $laRondeRepository): Response
    {
        return $this->render('la_ronde/index.html.twig', [
            'la_rondes' => $laRondeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_la_ronde_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LaRondeRepository $laRondeRepository): Response
    {
        $laRonde = new LaRonde();
        $laRonde->setAgent($this->getUser());
        $form = $this->createForm(LaRondeType::class, $laRonde);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $tmp = json_decode($form->get('data')->getData());
            $laRonde->setDateFin(new \DateTime());
            if($tmp!==null && count($tmp)>0){
                $groupe=  $this->createGroupage($tmp);
                foreach($groupe as $g){
                    $laRonde->addGroupage($g);
                }
            }
            $laRondeRepository->add($laRonde, true);

            return $this->redirectToRoute('app_la_ronde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('la_ronde/new.html.twig', [
            'la_ronde' => $laRonde,
            'form' => $form,
        ]);
    }

    public function createGroupage($tab):array{
        $groupes = [];
        foreach($tab as $el){
            $groupage = new Groupage();
            $event = new Evenements();
            $event->setHeure(new DateTime($el->{'heure'}));
            $event->setObservation($el->{'observation'});
            
            $type_rep = $this->getDoctrine()->getManager()->getRepository(TypeEvenements::class);
            $point_rep = $this->getDoctrine()->getManager()->getRepository(Pointaux::class);
            $pointaux = $point_rep->findOneBy(['libelle' => $el->{'pointaux'}]);
            $type = $type_rep->findOneBy(['libelle' => $el->{'type'}]);
            $event->setTypeEvenement($type);
            $groupage->setPointau($pointaux);
            $groupage->setEvenement($event);
            $groupes[] = $groupage;

        }
        return $groupes;
    }
    /**
     * @Route("/{id}", name="app_la_ronde_show", methods={"GET"})
     */
    public function show(LaRonde $laRonde): Response
    {
        return $this->render('la_ronde/show.html.twig', [
            'la_ronde' => $laRonde,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_la_ronde_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, LaRonde $laRonde, LaRondeRepository $laRondeRepository): Response
    {
        $form = $this->createForm(LaRondeType::class, $laRonde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $laRondeRepository->add($laRonde, true);

            return $this->redirectToRoute('app_la_ronde_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('la_ronde/edit.html.twig', [
            'la_ronde' => $laRonde,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_la_ronde_delete", methods={"POST"})
     */
    public function delete(Request $request, LaRonde $laRonde, LaRondeRepository $laRondeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laRonde->getId(), $request->request->get('_token'))) {
            $laRondeRepository->remove($laRonde, true);
        }

        return $this->redirectToRoute('app_la_ronde_index', [], Response::HTTP_SEE_OTHER);
    }
}
