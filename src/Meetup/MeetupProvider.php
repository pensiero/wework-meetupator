<?php

namespace App\Meetup;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Exception\GuzzleException;

class MeetupProvider
{
    const API_MEETUP_GROUP = 'https://api.meetup.com/%s';

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
     * Giving a raw url, it find the slug of the Meetup group
     *
     * @param $url
     *
     * @return string
     */
    private function findMeetupGroupSlugByRawUrl($url)
    {
        $regex = '/meetup\.com\/(.{2}-.{2}\/)?(.*)\//m';

        preg_match($regex, $url, $matches);

        return $matches[2];
    }

    /**
     * Giving a url, it will find a MUG through the Meetup API
     *
     * @param string $url
     *
     * @return array
     */
    public function findMeetupByUrl($url): array
    {
        $meetupGroupSlug = $this->findMeetupGroupSlugByRawUrl($url);

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', sprintf(self::API_MEETUP_GROUP, $meetupGroupSlug));
        } catch (GuzzleException $e) {
            return null;
        }

        return (array) json_decode($response->getBody()->getContents());
    }
}