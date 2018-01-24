<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competition
 *
 * @ORM\Table(name="competition")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

	 /**
	* @ORM\OneToMany(targetEntity="ApiBundle\Entity\PlayerCompetition",mappedBy="competition")
	*/
	private $players;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Competition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Competition
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add player
     *
     * @param \ApiBundle\Entity\PlayerCompetition $player
     *
     * @return Competition
     */
    public function addPlayer(\ApiBundle\Entity\PlayerCompetition $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \ApiBundle\Entity\PlayerCompetition $player
     */
    public function removePlayer(\ApiBundle\Entity\PlayerCompetition $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
