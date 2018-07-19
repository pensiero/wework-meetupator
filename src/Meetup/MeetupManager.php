<?php

namespace App\Meetup;

use App\Entity\Meetup;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\GuzzleException;

class MeetupManager
{
    const API_EVENT = 'https://api.meetup.com/%s/events';

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
     * Create a new Meetup
     *
     * @param string $sourceId
     * @param string $name
     *
     * @return Meetup
     */
    public function createMeetup($sourceId, $name, $url): Meetup
    {
        $meetup = new Meetup();
        $meetup->setSourceId($sourceId);
        $meetup->setName($name);
        $meetup->setUrl($url);

        $this->em->persist($meetup);
        $this->em->flush();

        return $meetup;
    }

    /**
     * Create a new Meetup Event
     *
     * @param Meetup $meetup
     * @param array  $data
     *
     * @return bool
     */
    public function addMeetupEvent(Meetup $meetup, $data): bool
    {
        $client = new \GuzzleHttp\Client();
        //try {
            $response = $client->request(
                'POST',
                sprintf(self::API_EVENT, $meetup->getUrl()),
                [
                    'query' => ['key' => getenv('API_KEY')],
                    'form_params' => [
                        'name'        => $data['name'],
                        'time'        => $data['time'] * 1000,
                        'duration'    => $data['duration'],
                        'description' => $data['description'],
                        'lat'         => $data['latitude'],
                        'long'        => $data['longitude'],
                    ],
                ]
            );
        //} catch (GuzzleException $e) {
        //    return false;
        //}

        return true;
    }
}