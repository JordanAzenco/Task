<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;



class UserController extends AbstractController
{  
    
    /**
    *  
    *
   * @Route("/create", name="user_create") 
    */
    public function create(Request $request)
    {
        if ($request->isXmlHttpRequest()){
           
            $data = json_decode(
                $request->getContent(),
                true
            );
        }
       

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        

        $userName = $data["userName"];
        $UserEmail = $date["userEmail"];
        $usePassword = $date["userPassword"];
        

        $user->setName($userName);
        $user->setEmail($UserEmail);
        $user->setPassword($usePassword);

        
        // creates a task and gives it some dummy data for this example
      
        $entityManager->persist($user);
        $entityManager->flush();
        $lastId = $user->getId();
        $data["id"] = $lastId;

       
        return new JsonResponse($data);
        
        }
        
        
        
        /**
         * Matches /
        * @Route("/", name="user_log")
        */
        public function log(Request $request){

            if ($request->isXmlHttpRequest()){
           
                $data = json_decode(
                    $request->getContent(),
                    true
                );
            
            $userName = $data["userName"];
            $userPassword = $data["userPassword"];
            $task = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($userName);
        }
            return $this->render('user/con_inscr.html.twig');
       
            
            
            
        }
        /**
        * @Route("/task/update",options={"expose"=true}, name="task_update") 
        */
        public function update(Request $request)
        {
            if ($request->isXmlHttpRequest()){
                $data = json_decode(
                    $request->getContent(),
                    true
                );
            }
            
            $id = $data["id"];
            $taskName = $data["taskname"];
            $taskDueDate = $data["taskDueDate"]; 
            $entityManager = $this->getDoctrine()->getManager();
            $task = $entityManager->getRepository(Task::class)->find($id);    
            
            
            $task->setTask($taskName);
            $taskDueDate = new \DateTime($taskDueDate);
            $taskDueDate->format('d-m-Y');
            $task->setDueDate($taskDueDate);
            
            $entityManager->flush();
            
            return new JsonResponse($data);
            
            
        }
        
        
        /**
        * @Route("/task/delete",options={"expose"=true}, name="task_delete", methods={"POST"}) 
        */
        public function delete(Request $request)
        {
            if ($request->isXmlHttpRequest()){
                $data = json_decode(
                    $request->getContent(),
                    true
                );
            }
            
            $id = $data;
            if($id){
                
                
                $entityManager = $this->getDoctrine()->getManager();
                $task = $entityManager->getRepository(Task::class)->find($id);
                
                $entityManager->remove($task);
                $entityManager->flush(); 
                
                
                
            }
            return new JsonResponse($id);
            
        }
        
        
    }
    
    
    