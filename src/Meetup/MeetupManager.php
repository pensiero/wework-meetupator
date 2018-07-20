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
     * @param array  $events
     *
     * @return bool
     * @throws GuzzleException
     */
    public function addMeetupEvent(Meetup $meetup, $events): bool
    {
        $client = new \GuzzleHttp\Client();

        foreach ($events as $event) {
            $client->request(
                'POST',
                sprintf(self::API_EVENT, $meetup->getUrl()),
                [
                    'query' => ['key' => getenv('API_KEY')],
                    'form_params' => [
                        'name'        => $event['name'],
                        'time'        => $event['time'] * 1000,
                        'duration'    => $event['duration'],
                        'description' => $event['description'],
                        'lat'         => $event['latitude'],
                        'lon'         => $event['longitude'],
                    ],
                ]
            );
        }

        return true;
    }
}