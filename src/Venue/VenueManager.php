<?php

namespace App\Venue;

use App\Entity\Meetup;
use App\Entity\Venue;
use App\Meetup\MeetupManager;
use Doctrine\ORM\EntityManagerInterface;

class VenueManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var MeetupManager
     */
    protected $meetupManager;

    /**
     * @param EntityManagerInterface $em
     * @param MeetupManager          $meetupManager
     */
    public function __construct(EntityManagerInterface $em, MeetupManager $meetupManager)
    {
        $this->em = $em;
        $this->meetupManager = $meetupManager;
    }

    /**
     * Create a new Venue
     *
     * @param string $sourceId
     * @param string $name
     * @param string $url
     * @param Meetup $meetup
     *
     * @return Venue
     */
    public function createVenue($sourceId, $name, $url, Meetup $meetup): Venue
    {
        $venue = new Venue();
        $venue->setSourceId($sourceId);
        $venue->setName($name);
        $venue->setUrl($url);
        $venue->setMeetup($meetup);

        $this->em->persist($venue);
        $this->em->flush();

        return $venue;
    }

    /**
     * Crawl a Venue
     *
     * @param Venue $venue
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function crawlVenue(Venue $venue)
    {
        $event = [
            [
                'time'        => (new \DateTime('2018-07-19 16:00:00'))->getTimestamp(),
                'duration'    => 3600000,
                'name'        => 'Happy Hour: Beer Tasting With BRLO',
                'description' => 'Please join us for our Happy Hour where we will be treated to a tasting session with BRLO craft beer with a range of IPAs and Lager. See you there and feel free to bring your friends! And Vote for your Favourite and will put it on tap for a month.',
                'latitude'    => 52.506378,
                'longitude'   => 13.3732382,
            ],
            [
                'time'        => (new \DateTime('2018-07-20 06:30:00'))->getTimestamp(),
                'duration'    => 3600000,
                'name'        => 'Hackshow WebDev Ironhack Berlin',
                'description' => 'Want to see the amazing projects our students have built during the bootcamp? We invite you to join our first Ironhack Berlin Hackshow on July 20th! During their 9 weeks at Ironhack, our students have dedicated more than 500 hours to learning various web programming languages with a focus on picking up good development practices. During the Hackshow, 3 of our best and brightest web development bootcamp graduates will be presenting their final projects - a culmination of 9 weeks of hard work. We invite those interested in technology & startups, people looking to hire web developers, or just anyone that would like to learn more about coding and our program to join!',
                'latitude'    => 52.506378,
                'longitude'   => 13.3732382,
            ],
            [
                'time'        => (new \DateTime('2018-07-23 07:00:00'))->getTimestamp(),
                'duration'    => 3600000,
                'name'        => 'TGIM Breakfast',
                'description' => 'Rise and shine dear Hackescher Markt Community! It’s a new week and we would love to see you over breakfast or some coffee, chat about your weekend and hear about your exciting plans for this week. Happy Monday and hustle on!',
                'latitude'    => 52.506378,
                'longitude'   => 13.3732382,
            ],
        ];

        $this->meetupManager->addMeetupEvent($venue->getMeetup(), $event);
    }
}