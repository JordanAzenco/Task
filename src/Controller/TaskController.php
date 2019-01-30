<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TaskType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class TaskController extends AbstractController
{  /**
    * Matches /
    *
    * @Route("/task-add", name="task_add")
    */
    public function new(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $duedate = new \DateTime('tomorrow');
        $duedate -> format("Y-m-d");
        $task->setDueDate($duedate);
        
        
        
        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
            
            
          
            
            $task = $form->getData(); 
          
            $entityManager->persist($task);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'La tâche a bien été créée'
            );
            return $this->redirectToRoute('task_show');
            
        }elseif($form->isSubmitted() && !$form->isValid()){
            $this->addFlash(
                'notice',
                'La tâche n\'a pas été créée'
            );
            return $this->redirectToRoute('task_show');
            
        }
        
        
        return $this->render('task/add.html.twig', [
            'form' => $form->createView(),
          
            
            
            ]);
        }



        /**
        * @Route("/", name="task_show")
        */
        public function show(){
            $repository = $this->getDoctrine()->getRepository(Task::class);
            
            $task = $repository->findAll();
            
            if(!$task){
                $this->addFlash(
                    'notice',
                    'Il n\'y a aucune tâche en cours'
                );
            }
            
            /* foreach ( $task as $tasks) {
                $result[] = $tasks;
            }  */
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
            $task->setdueDate(new \DateTime($taskDueDate));
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
    
    
    