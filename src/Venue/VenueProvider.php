<?php

namespace App\Venue;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\GuzzleException;

class VenueProvider
{
    // API: all WeWork buildings
    const API_ALL_BUILDINGS = 'http://locations-api.wework.com/api/v2/buildings';

    // API: single building based on id
    const API_BUILDING = 'http://locations-api.wework.com/api/v2/buildings/%s';

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Giving an id, it will find a WeWork Building through the WeWork API
     *
     * @param string $id
     *
     * @return array
     */
    public function findVenueById($id): array
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', sprintf(self::API_BUILDING, $id));
        } catch (GuzzleException $e) {
            return null;
        }

        return (array) json_decode($response->getBody()->getContents())->building;
    }

    /**
     * Get all the Work Buildings through the WeWork API
     *
     * @return array
     */
    public function findAvailableVenues(): array
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', self::API_ALL_BUILDINGS);
        } catch (GuzzleException $e) {
            return [];
        }

        return json_decode($response->getBody()->getContents())->buildings;
    }

    /**
     * Get all the venues registered in the database and associated to a Meetup
     *
     * @return mixed
     */
    public function getAssociatedVenues()
    {
        return $this
            ->em
            ->createQueryBuilder()
            ->select('n')
            ->from('App:Venue', 'n')
            ->orderBy('n.name', 'asc')
            ->getQuery()
            ->getResult();
    }
}