<?php

namespace App\Controller;

use App\Meetup\MeetupManager;
use App\Meetup\MeetupProvider;
use App\Venue\VenueManager;
use App\Venue\VenueProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var VenueProvider
     */
    protected $venueProvider;

    /**
     * @var VenueManager
     */
    protected $venueManager;

    /**
     * @var MeetupProvider
     */
    protected $meetupProvider;

    /**
     * @var MeetupManager
     */
    protected $meetupManager;

    /**
     * @param VenueProvider $venueProvider
     */
    public function __construct(VenueProvider $venueProvider, VenueManager $venueManager, MeetupProvider $meetupProvider, MeetupManager $meetupManager)
    {
        $this->venueProvider = $venueProvider;
        $this->venueManager = $venueManager;
        $this->meetupProvider = $meetupProvider;
        $this->meetupManager = $meetupManager;
    }

    /**
     * @Route("/", name="home")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $availableVenues = $this->venueProvider->findAvailableVenues();
        $associatedVenues = $this->venueProvider->getAssociatedVenues();

        return $this->render('index/index.html.twig', [
            'availableVenues'  => $availableVenues,
            'associatedVenues' => $associatedVenues,
        ]);
    }

    /**
     * @Route("/connect", name="connect")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connect(Request $request)
    {
        if ($request->isMethod('POST')) {

            $venueId = $request->request->get('venue_id');
            $meetupUrl = $request->request->get('meetup_url');

            // find meetup by meetup url
            $rawMeetup = $this->meetupProvider->findMeetupByUrl($meetupUrl);

            // create the Meetup
            $meetup = $this->meetupManager->createMeetup($rawMeetup['id'], $rawMeetup['name'], $rawMeetup['urlname']);

            // find raw venue data by venue source id
            $rawVenue = $this->venueProvider->findVenueById($venueId);

            // create the Venue and associate it to the Meetup
            $venue = $this->venueManager->createVenue($rawVenue['id'], $rawVenue['name'], $rawVenue['path'], $meetup);
        }

        return $this->forward('App\Controller\IndexController::index');
    }

    /**
     * @Route("/crawl", name="crawl")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function crawl(Request $request)
    {
        if ($request->isMethod('POST')) {
            $venueId = $request->request->get('venue_id');
            $venue = $this->venueProvider->getVenue($venueId);
            $this->venueManager->crawlVenue($venue);
        }

        return $this->forward('App\Controller\IndexController::index');
    }
}