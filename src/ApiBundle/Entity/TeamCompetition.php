<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TeamCompetition
 *
 * @ORM\Entity
 */
class TeamCompetition
{
    
    
    /**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Team")
	*/
	private $team;
    
    /**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Competition")
	*/
	private $competition;
    
    /**
     * @var int
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

	
    /**
     * @var int
     *
     * @ORM\Column(name="goals", type="integer")
     */
    private $goals;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="goalsAgainst", type="integer")
     */
    private $goalsAgainst;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="victories", type="integer")
     */
    private $victories;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="draws", type="integer")
     */
    private $draws;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="losts", type="integer")
     */
    private $losts;
    
    

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return TeamCompetition
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set goals
     *
     * @param integer $goals
     *
     * @return TeamCompetition
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * Get goals
     *
     * @return integer
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set goalsAgainst
     *
     * @param integer $goalsAgainst
     *
     * @return TeamCompetition
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    /**
     * Get goalsAgainst
     *
     * @return integer
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return TeamCompetition
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set victories
     *
     * @param integer $victories
     *
     * @return TeamCompetition
     */
    public function setVictories($victories)
    {
        $this->victories = $victories;

        return $this;
    }

    /**
     * Get victories
     *
     * @return integer
     */
    public function getVictories()
    {
        return $this->victories;
    }

    /**
     * Set draws
     *
     * @param integer $draws
     *
     * @return TeamCompetition
     */
    public function setDraws($draws)
    {
        $this->draws = $draws;

        return $this;
    }

    /**
     * Get draws
     *
     * @return integer
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * Set losts
     *
     * @param integer $losts
     *
     * @return TeamCompetition
     */
    public function setLosts($losts)
    {
        $this->losts = $losts;

        return $this;
    }

    /**
     * Get losts
     *
     * @return integer
     */
    public function getLosts()
    {
        return $this->losts;
    }

    /**
     * Set team
     *
     * @param \ApiBundle\Entity\Team $team
     *
     * @return TeamCompetition
     */
    public function setTeam(\ApiBundle\Entity\Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \ApiBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set competition
     *
     * @param \ApiBundle\Entity\Competition $competition
     *
     * @return TeamCompetition
     */
    public function setCompetition(\ApiBundle\Entity\Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \ApiBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}
