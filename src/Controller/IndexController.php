<?php

namespace App\Controller;

use App\Venue\VenueProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var VenueProvider
     */
    protected $venueProvider;

    /**
     * @param VenueProvider $venueProvider
     */
    public function __construct(VenueProvider $venueProvider)
    {
        $this->venueProvider = $venueProvider;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $availableVenues = $this->venueProvider->findAvailableVenues();
        $associatedVenues = $this->venueProvider->getAssociatedVenues();

        return $this->render('index/index.html.twig', [
            'availableVenues'  => $availableVenues,
            'associatedVenues' => $associatedVenues,
        ]);
    }
}