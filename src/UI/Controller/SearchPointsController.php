<?php

declare(strict_types=1);

namespace App\UI\Controller;

use App\Application\Service\InpostPoints;
use App\UI\Form\SearchPoints as SearchPointsForm;
use App\UI\Form\Model\SearchPoints as SearchPointsModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchPointsController extends AbstractController
{
    const PER_PAGE = 500;
    public function __construct(private InpostPoints $inpostPoints)
    {
    }

    public function search(Request $request): Response
    {
        $form = $this->createForm(SearchPointsForm::class, new SearchPointsModel());
        $form->handleRequest($request);
        $data = [];
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SearchPointsModel $searchPoints */
            $searchPoints = $form->getData();
            $data = $this->inpostPoints->fetchAll(
                InpostPoints::POINTS_METHOD,
                ['city' => $searchPoints->city]
            );
        }

        return $this->render('inpost/search_points.html.twig', [
            'form' => $form,
            'points' => $data
        ]);
    }
}
