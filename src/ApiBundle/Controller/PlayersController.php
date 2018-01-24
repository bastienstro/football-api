<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Entity\Team;
use ApiBundle\Entity\Competition;
use ApiBundle\Entity\Player;
use ApiBundle\Form\PlayerType;

class PlayersController extends FOSRestController {
	
  public function sendResponseWithETag(Request $request,\FOS\RestBundle\View\View $response) {
	 
	$content = $this->handleView($response);
	$response->getResponse()->setEtag(md5($content));
	$response->getResponse()->setPublic();
	  
	/** compare the 'if-not-match' from the request to the etag
		  send 304 not modified if match **/   
	if (!$response->getResponse()->isNotModified($request))
	    return $content;
	else	
	    return $this->view('',Response::HTTP_NOT_MODIFIED);
  }
  
  
  /**
  * @View()
  * @Get("/teams")
  */

  public function getTeamsAction(Request $request) {
	         
        $repository = $this->getDoctrine()
		       ->getManager()
		       ->getRepository('ApiBundle:Team');

        $teams = $repository->findAll();				       
        $response = $this->view($teams);

        return $this->sendResponseWithETag($request,$response);

  }
    
  /**
  * @View()
  * @Get("/teams/{team}", requirements={"team" = "\d+"})
  */
 
    
  public function getPlayersByTeamAction(Team  $team,Request $request) {
	    
	$response = $this->view($team->getPlayers());
        return $this->sendResponseWithETag($request,$response);
  }  
       
  /**
  * @View()
  * @Get("/competitions/{player}", requirements={"player" = "\d+"})
  */

  public function getCompetitionsAction(Player $player,Request $request) {
	    
	$competitions = $player->getCompetitions();
	$array = array();
	
	foreach($player->getCompetitions() as $compo) {
	    $array[] = array('competition' => $compo->getCompetition(),'goals' => $compo->getGoals(),'assist' => $compo->getAssists())	;
	}
	
	$response = $this->view($array);
        return $this->sendResponseWithETag($request,$response);
	    
  }
    
  /**
  * @View()
  * @Post("/players/new")
  */
  
  public function postPlayerAction(Request $request) {
	    
	$player = new Player;
	$form = $this->get('form.factory')->createNamed('',PlayerType::class, $player,array('method' => 'POST'));
        $form->handleRequest($request);
 
        if ($form->isValid()) {
             
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();
            $status_code = 200;
            $message = array("status"=> "valid",
			     "status_code"=> 200,
			     "message" => $player->getName()." ".$player->getLastName()." has been created"
			    );
        }
        else {
	    $status_code = 400;	 
	    $message = array("status"=> "bad request",
			     "status_code"=> 400,
		             "message" => "some parameters are wrong");
 	}
        
        $response = $this->view($message,$status_code);
        return $this->sendResponseWithETag($request,$response);
	
        
  }
    
  /**
  * @View()
  * @Put("/players/{player}", requirements={"player" = "\d+"})
  */
    
  public function putPlayerAction(Player $player,Request $request) {
		
        $form = $this->get('form.factory')->createNamed('',PlayerType::class, $player,array('method' => 'PUT'));
        $form->handleRequest($request);
 
        if ($form->isValid()) {
             
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();
            $status_code = 200;
            $message = array("status"=> "valid",
			     "status_code"=> 200,
			     "message" => $player->getName()." ".$player->getLastName()." has been updated"
			    );
        }
        else {
	    $status_code = 400;	 
	    $message = array("status"=> "bad request",
			     "status_code"=> 400,
			     "message" => "some parameters are wrong");
	        	 
        }

        $response = $this->view($message,$status_code);
    	return $this->sendResponseWithETag($request,$response);
	    
    }
    
  /**
  * @View()
  * @Delete("/players/{player}", requirements={"player" = "\d+"})
  */

  public function deletePlayerAction(Player $player,Request $request) {

	$em = $this->getDoctrine()->getManager();
        $em->remove($player);
        $em->flush();
          
	$message = array("status"=> "valid",
			 "status_code"=> 200,
			 "message" => $player->getName()." ".$player->getLastName()." has been removed"
			);
	    
	$response = $this->view($message);
        return $this->sendResponseWithETag($request,$response);
  }

  /**
  * @View()
  * @Patch("/teams/{team}/{player}", requirements={"team" = "\d+"},requirements={"player" = "\d+"})
  */
 
  public function assignTeamAction(Team $team,Player $player,Request $request) {

	$player->setTeam($team);
	$em = $this->getDoctrine()->getManager();
        $em->persist($player);
        $em->flush();
        
        $message = array("status"=> "valid",
		         "status_code"=> 200,
			 "message" => $player->getName()." ".$player->getLastName()." has been assigned to ".$team->getName()
			);
	    
	$response = $this->view($message);
        return $this->sendResponseWithETag($request,$response);

  }

  /**
  * @View()
  * @Get("/competitions/{competition}/players", requirements={"competition" = "\d+"})
  */
  
  public function getCompetitionPlayersAction(Competition $competition,Request $request) {
	    
	$players=array();
    	foreach($competition->getPlayers() as  $player) {
	    $players[] = $player->getPlayer();
	}
	    
	if (empty($players)) {
	    $message = array("status"=> "valid",
		             "status_code"=> 204,
			     "message" => "No Content"
			    );
	    
	    $response = $this->view($message,204);
	}
	else
	    $response = $this->view($players);
        
        return $this->sendResponseWithETag($request,$response);
	    
  }
  /**
  * @View()
  * @Get("/competitions/{competition}/teams", requirements={"competition" = "\d+"})
  */
  
  public function getTeamsPlayerssAction(Competition $competition,Request $request) {
	    
	$em = $this->getDoctrine()->getManager();
	$teams = $em->getRepository('ApiBundle:Team')
		    ->findTeamByCompetitionPlayers($competition);
	    
	if (empty($teams)) {
	    $message = array("status"=> "valid",
		             "status_code"=> 204,
			     "message" => "No Content"
			    );
	    
	    $response = $this->view($message,204);
	}
	else
	    $response = $this->view($teams);
        return $this->sendResponseWithETag($request,$response);
	    
    }
   
    /**
	* @View()
	* @QueryParam(name="name",requirements="[a-z]+", nullable=true)
	* @QueryParam(name="lastname",requirements="[a-z]+", nullable=true)
	* @QueryParam(name="height", requirements="\d+", nullable=true)
	* @QueryParam(name="weight", requirements="\d+", nullable=true)
	* @QueryParam(name="country",requirements="[a-z]+", nullable=true)
	* @QueryParam(name="age", requirements="\d+", nullable=true)
	* @QueryParam(name="rightFoot",requirements="\d+", nullable=true)
	* @QueryParam(name="height",requirements="\d+", nullable=true)
    * @param ParamFetcher $paramFetcher
    * @Get("/players")
    */
  
    public function getPlayersAction(ParamFetcher $paramFetcher,Request $request) {
	    
	    $players = $this->getDoctrine()
	        			 ->getManager()
	        			 ->getRepository('ApiBundle:Player');
	    
	    $filters = array_filter($paramFetcher->all(),function($value) { return $value !== null; });
		
		$players = $players->findBy($filters);
	    
	    if (empty($players)) {
		    $message = array("status"=> "valid",
								 "status_code"=> 204,
								 "message" => "No Content");
	    
			$response = $this->view($message,204);
		}
		else
	    	$response = $this->view($players);
	    
	    
        return $this->sendResponseWithETag($request,$response);
	    
    }
  
    /**
     * @QueryParam(name="name",requirements="[a-z]+", nullable=true)
     * @QueryParam(name="lastname",requirements="[a-z]+", nullable=true)
     * @QueryParam(name="height",requirements="\d+", nullable=true)
     * @QueryParam(name="weight",requirements="\d+", nullable=true)
     * @QueryParam(name="country",requirements="[a-z]+", nullable=true)
     * @QueryParam(name="age", requirements="\d+", nullable=true)
     * @QueryParam(name="rightFoot", requirements="\d+", nullable=true)
     * @QueryParam(name="height",requirements="\d+", nullable=true)
     * @param ParamFetcher $paramFetcher
     * @Get("/teams/{team}/players", requirements={"team" = "\d+"})
     */
    
    public function getTeamPlayersAction(Team $team,ParamFetcher $paramFetcher,Request $request) {
	    
	    
	  $players = $this->getDoctrine()
	  	          ->getManager()
	        	  ->getRepository('ApiBundle:Player');
	        				   
	  $filters = array_filter($paramFetcher->all(),function($value) { return $value !== null; });
	  $filters['team'] = $team->getId();
	  $players = $players->findBy($filters);
	   
	  if (empty($players)) {
	      $message = array("status"=> "valid",
			       "status_code"=> 204,
			       "message" => "No Content"
			      );
	    
	      $response = $this->view($message,204);
	  }
	  else
	      $response = $this->view($players);
	    
	    
         return $this->sendResponseWithETag($request,$response);
	  
    }
    
}
