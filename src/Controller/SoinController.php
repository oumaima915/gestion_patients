<?php

namespace App\Controller;

use App\Entity\Soin;
use App\Form\SoinType;
use App\Repository\SoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soin")
 */
class SoinController extends AbstractController
{
    /**
     * @Route("/", name="soin_index", methods={"GET"})
     */
    public function index(SoinRepository $soinRepository): Response
    {
        return $this->render('soin/index.html.twig', [
            'soins' => $soinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="soin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $soin = new Soin();
        $form = $this->createForm(SoinType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($soin);
            $entityManager->flush();

            return $this->redirectToRoute('soin_index');
        }

        return $this->render('soin/new.html.twig', [
            'soin' => $soin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soin_show", methods={"GET"})
     */
    public function show(Soin $soin): Response
    {
        return $this->render('soin/show.html.twig', [
            'soin' => $soin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="soin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Soin $soin): Response
    {
        $form = $this->createForm(SoinType::class, $soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soin_index');
        }

        return $this->render('soin/edit.html.twig', [
            'soin' => $soin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Soin $soin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('soin_index');
    }
}
