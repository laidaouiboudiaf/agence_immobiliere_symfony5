<?php

namespace App\Controller\Admin;

use App\Form\OwnersType;
use App\Repository\OwnersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Owners;


class AdminOwnerController extends AbstractController
{

    private \Doctrine\Persistence\ObjectManager $ManagerRegistry;

    public function __construct(OwnersRepository $ownersRepository, ManagerRegistry $doctrine)
    {
        $this->ManagerRegistry = $doctrine->getManager();

        $this->ownersRepository = $ownersRepository;


    }


    /**
     * @Route("/admin", name="admin.owner")
     */
    public function index(): Response
    {
        $properties = $this->ownersRepository->findAll();
        return $this->render('admin_owner/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/owner/new", name="admin.owner.new")
     */
    public function new(Request $request)
    {

        $property = new Owners();
        $form = $this->createForm(OwnersType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->ManagerRegistry->persist($property);
            $this->ManagerRegistry->flush();

            return $this->redirectToRoute('admin.owner');
        }
        return $this->renderForm('admin_owner/new.html.twig', [


            'form' => $form]);

    }

    /**
     * @Route("/admin/owner/edit/{id}", name="admin.owner.edit",methods="GET|POST")
     */
    public function edit(Owners $property, Request $request)
    {

        $form = $this->createForm(OwnersType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->ManagerRegistry->flush();
            return $this->redirectToRoute('admin.owner');
        }
        return $this->renderForm('admin_owner/edit.html.twig', [

            'form' => $form,]);

    }

    /**
     * @Route("/admin/owner/remove/{id}", name="admin.owner.delete")
     */
    public function remove(Owners $property)
    {

        $this->ManagerRegistry->remove($property);
        $this->ManagerRegistry->flush();
        return $this->redirectToRoute('admin.owner');

    }


}



