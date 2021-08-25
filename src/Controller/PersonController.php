<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/api/person", name="api_person", methods="GET")
     */
    public function index(PersonRepository $personRepository,NormalizerInterface $normalizer): Response
    {
        $personnes = $personRepository->findAll();
        $normalized = $normalizer->normalize($personnes,null,['groups'=>'person:read']);
        $json = json_encode($normalized);
        $reponse = new Response($json, 200, 
        ['content-type' => 'application/json']);
        return $reponse;
    }

    /**
     * @Route("/api/person/{id}", name="api_person_avec_id", methods="GET")
     */
public function findById(PersonRepository $personRepository,$id,NormalizerInterface $normalizer): Response
{
$person = $personRepository->find($id);
$normalized = $normalizer->normalize($person,null,['groups'=>'person:read']);
$json = json_encode($normalized);
$reponse = new Response($json, 200,
[
    'content-type' => 'application/json'
]);
return $reponse;
}
}
