<?php
	
namespace ApiBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;


class MyExceptionListener 
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        
         $exception =  $event->getException();
        if ($exception instanceof NotFoundHttpException) {
            //create response, set status code etc.
            $response = new Response();
            $response->setStatusCode(404);
            $response->setContent(json_encode(array("status"=> "error",
													"status_code"=> 404,
													"message" => "data not found")));
            $event->setResponse($response); 
        
        
        }
        
         if ($exception instanceof ORMException) {
            //create response, set status code etc.
            $response = new Response();
            $response->setStatusCode(400);
            $response->setContent(json_encode(array("status"=> "error",
													"status_code"=> 400,
													"message" => "filters are wrong")));
            $event->setResponse($response); 
        
        
        }
        
        if ($exception instanceof MethodNotAllowedHttpException) {
            //create response, set status code etc.
            $response = new Response();
            $response->setStatusCode(405);
            $response->setContent(json_encode(array("status"=> "error",
													"status_code"=> 405,
													"message" => "method not allowed")));
            $event->setResponse($response); 
        
        
        }
        
        if ($exception instanceof NotNullConstraintViolationException) {
            //create response, set status code etc.
            $response = new Response();
            $response->setStatusCode(400);
            $response->setContent(json_encode(array("status"=> "error",
													"status_code"=> 400,
													"message" => "parameters are missing")));
            $event->setResponse($response); 
        
        
        }


        
       
    }
}