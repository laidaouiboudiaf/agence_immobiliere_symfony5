<?php

namespace App\Controller;

use App\Entity\Owners;
use App\Entity\OwnerSearch;
use App\Form\OwnerSearchType;
use App\Repository\OwnersRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use symfony\component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class OwnerController extends AbstractController
{
    private OwnersRepository $ownersRepository;
    private ObjectManager $ManagerRegistry;

    public function __construct(OwnersRepository $ownersRepository, ManagerRegistry $doctrine)
    {
        $this->ManagerRegistry = $doctrine->getManager();

        $this->ownersRepository = $ownersRepository;


    }

    /**
     * @Route("/owners", name="owner")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new OwnerSearch();
        $form = $this->createForm(OwnerSearchType::class, $search);
        $form->handleRequest($request);
        $properties = $paginator->paginate(
            $this->ownersRepository->findAllProperties($search),
            $request->query->getInt('page', 1), 12

        );


        return $this->render('pages/owner.html.twig', [
            'current_menu' => 'propreties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
        dd($form);
    }

    /**
     * @Route("/owners/{slug}-{id}", name="owner.show" ,requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Owners $owners, string $slug): Response
    {
        if ($owners->getSlug() !== $slug)
            return $this->redirectToRoute('owner.show', [
                'id' => $owners->getId(),
                'slug' => $owners->getSlug()
            ]);

        return $this->render('pages/show.html.twig', [
            'properties' => $owners
        ]);
    }
}
/*$entityManager= $doctrine->getManager();

        $owner = new Owners();
        $owner->setTitle('BourgesAPPART')
            ->setDiscription('Un debut pour tout')
            ->setAddress('32 rue des minimes')
            ->setBedrooms('4')
            ->setCity('Paris')
            ->setSurface('622')
            ->setFloor('5')
            ->setPostalCode('18221')
            ->setRooms('5')
            ->setPrice('100');

        $entityManager->persist($owner);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
dd($owner);
update BDD
$property = $this->ownersRepository->findAll();
$property[1]->setTitle('VieuxPort');            */