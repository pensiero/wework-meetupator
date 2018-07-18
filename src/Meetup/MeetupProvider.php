<?php

namespace App\Meetup;

use Doctrine\ORM\EntityManagerInterface;

class MeetupProvider
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
     * Giving a url, it will find a MUG through the Meetup API
     * TODO
     *
     * @param string $url
     */
    public function findMeetupByUrl($url)
    {

    }
}