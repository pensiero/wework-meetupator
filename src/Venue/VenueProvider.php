<?php

namespace App\Venue;

use Doctrine\ORM\EntityManagerInterface;

class VenueProvider
{
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
     * Giving a  name, it will find a WeWork Building through the WeWork API
     * TODO
     *
     * @param string $name
     */
    public function findVenueByName($name)
    {

    }

    /**
     * Get all the Work Buildings through the WeWork API
     * TODO
     */
    public function findVenues()
    {
    }

    /**
     * Get all the venues registered in the database
     *
     * @return mixed
     */
    public function getAllVenues()
    {
        return $this
            ->em
            ->createQueryBuilder()
            ->select('n')
            ->from('App:Venue')
            ->orderBy('n.name', 'asc')
            ->getQuery()
            ->getResult();
    }
}