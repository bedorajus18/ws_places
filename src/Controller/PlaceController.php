<?php

namespace App\Controller;

use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PlaceController extends AbstractController
{
    /**
     * @Route("/api/place", name="api_place", methods="GET")
     */
    public function index(PlaceRepository $placeRepository,NormalizerInterface $normalizer): Response
    {
    $places = $placeRepository->findAll();
    $normalized = $normalizer->normalize($places,null,['groups'=>'place:read']);
    $json = json_encode($normalized);
    $reponse = new Response($json, 200,
    [
        'content-type' => 'application/json'
    ]);
    return $reponse;
    }

    /**
     * @Route("/api/place/{id}", name="api_place_avec_id")
     */
public function findById(PlaceRepository $placeRepository,$id,NormalizerInterface $normalizer): Response
    {
    $place = $placeRepository->find($id);
    $normalized = $normalizer->normalize($place,null,['groups'=>'place:read']);
    $json = json_encode($normalized);
    $reponse = new Response($json, 200,
    [
        'content-type' => 'application/json'
    ]);
    return $reponse;
    }
}
