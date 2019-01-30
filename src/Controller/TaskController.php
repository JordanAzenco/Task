<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


class TaskController extends AbstractController
{  /**
    * Matches /
    *
   * @Route("/task/create",options={"expose"=true}, name="task_create") 
    */
    public function new(Request $request)
    {
        if ($request->isXmlHttpRequest()){
           
            $data = json_decode(
                $request->getContent(),
                true
            );
        }
        $package = new Package(new EmptyVersionStrategy());

        $path_close =  $package->getUrl('build/images/close.png');
        $path_update = $package->getUrl('build/images/refresh-button.png');
        $entityManager = $this->getDoctrine()->getManager();
        $task = new Task();
        $data['close'] = $path_close;
        $data['update'] =  $path_update;

        $taskName = $data["taskname"];
        $taskDueDate = $data["taskDueDate"]; 

        $task->setTask($taskName);
        $taskDueDate = new \DateTime($taskDueDate);
        $taskDueDate->format('d-m-Y');
        $task->setDueDate($taskDueDate);
        // creates a task and gives it some dummy data for this example
      
        $entityManager->persist($task);
        $entityManager->flush();
        $lastId = $task->getId();
        $data["id"] = $lastId;

        $this->addFlash(
            'notice',
            'La tâche a bien été créée'
        );
        return new JsonResponse($data);
        
        }
        
        
        
        /**
        * @Route("/", name="task_show")
        */
        public function show(){

            $task = $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAllOrderByDesc();
            
            if(!$task){
                $this->addFlash(
                    'notice',
                    'Il n\'y a aucune tâche en cours'
                );
            }
         
            return $this->render('task/show.html.twig', ['tasks' => $task]);
            
            
            
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
    
    
    