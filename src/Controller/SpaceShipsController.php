<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use DateTime;
use DateTimeZone; 

class SpaceShipsController extends AbstractController
{
    private HttpClientInterface $client;
    private string $urlAPI = 'http://localhost:3000/spaceships';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/not-found", name="notfound", methods={"GET"})
     */
    public function notFound(): Response
    {
        return $this->render('not-found.html.twig');
    }

    /**
     * @Route("/space-ships", name="spaceship_list", methods={"GET"})
     */
    public function list(): Response
    {
        $response = $this->client->request('GET', $this->urlAPI);
        $spaceships = $response->toArray(); 
        

        return $this->render('spaceship-list.html.twig', [
            'spaceships' => $spaceships
        ]);
    }

    /**
     * @Route("/space-ships/new", name="spaceship_view_create", methods={"GET"})
     */
    public function new(): Response
    {
        return $this->render('spaceship-create.html.twig');
    }

    /**
     * @Route("/space-ships/delete/{id}", name="spaceship_delete", methods={"POST"})
     */
    public function delete(int $id): Response
    {
        $response = $this->client->request('DELETE', $this->urlAPI."/".$id);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return $this->redirectToRoute('spaceship_list');
        }
    }

    /**
     * @Route("/space-ships/{id}", name="spaceship_details", methods={"GET"})
     */
    public function details(int $id): Response
    {
        $response = $this->client->request('GET', $this->urlAPI.'/'.$id);
        if($response->getStatusCode() === 200) {
            $spaceship = $response->toArray(); 
            $spaceship['films'] = $spaceship['films'] ?? []; 
            $spaceship['pilots'] = $spaceship['pilots'] ?? [];

            return $this->render('spaceship-details.html.twig', [
                'spaceship' => $spaceship
            ]);
        } else { 
            return $this->redirectToRoute('notfound');
        }
    }

    /**
     * @Route("/space-ships/{id}", name="spaceship_update", methods={"POST"})
     */
    public function update(Request $request, int $id): Response
    {
        $spaceshipData = $request->request->all();
        $date = new DateTime('now', new DateTimeZone('UTC'));
        $spaceshipData['edited'] = $date->format('Y-m-d\TH:i:s.u\Z');

        $response = $this->client->request('PUT', $this->urlAPI."/".$id, [
            'json' => $spaceshipData
        ]);

        if ($response->getStatusCode() === 200) {
            return $this->redirectToRoute('spaceship_details', [
                'id' => $id,
                'success' => true
            ]);
        } else {
            return $this->redirectToRoute('spaceship_details', [
                'id' => $id,
                'success' => false
            ]);
        }
    }

    /**
     * @Route("/space-ships", name="spaceship_create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $response = $this->client->request('GET', $this->urlAPI);
        $spaceships = $response->toArray(); 
        $lastId = max(array_column($spaceships, 'id'));
        $date = new DateTime('now', new DateTimeZone('UTC'));

        $spaceshipData = $request->request->all();
        $spaceshipData['id'] = "".($lastId + 1);
        $spaceshipData['created'] = $date->format('Y-m-d\TH:i:s.u\Z');
        $spaceshipData['edited'] = $date->format('Y-m-d\TH:i:s.u\Z');
        $response = $this->client->request('POST', $this->urlAPI, [
            'json' => $spaceshipData
        ]);

        if ($response->getStatusCode() === 201) {
            return $this->redirectToRoute('spaceship_list');
        }

        return new Response('Failed to update spaceship', $response->getStatusCode());
    }
}
