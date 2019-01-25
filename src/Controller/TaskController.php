<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TaskType;
use Symfony\Component\HttpFoundation\Response;

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
        
        $task->setDueDate(new \DateTime('tomorrow'));
        /*   $tables[0]['first'] = "Alpha";
        $tables[0]['seconde'] = "Beta";
        $tables[0]['third'] = "Charlie";
        
        $tables[1]['first'] = "Alpha";
        $tables[1]['seconde'] = "Beta";
        $tables[1]['third'] = "Charlie"; */
        
        
        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
        
        /*  $contactFormData ="";
        $taskName ="";
        $dueDate="";
        $task =[];
        $contactFormDataObject =[];
        $stockerObj= []; */
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            /*  $contactFormData =[];
            foreach ( $form as $key => $value) {
                $contactFormData[$key] = $value->getData();
            } */
            
            
            $task = $form->getData(); 
            /*   foreach ($contactFormDataObject as $key => $value) {
                $stockerObj[$key] = $value;
            } */
            
            /*  $taskName = $form["task"]->getData();
            $dueDate = $form["dueDate"]->getData();
            
            $task =  $request->request->get('task'); */
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
            /* 'contactFormData' => $contactFormData,
            'taskName' => $taskName,
            'dueDate' => $dueDate,
            'tasks' => $task,
            'tables' => $tables,
            'contactFormDataObject' => $contactFormDataObject,
            'stockerObj' => $stockerObj, */
            
            
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
        * @Route("/task/update/{id}", name="task_update") 
        */
        public function update(Request $request, $id)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $task = $entityManager->getRepository(Task::class)->find($id);

            $form = $this->createForm(TaskType::class, $task);
        
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $task = $form->getData();
                $taskName = $form["task"]->getData();

                
                $dueDate = $form["dueDate"]->getData();
                $task->setTask($taskName);
                $task->setdueDate($dueDate);
                $entityManager->flush();
                return $this->redirectToRoute('task_show');
     
         
            }
            
            return $this->render('task/update.html.twig', [
                'form' => $form->createView(), 
                ]);
            
        }
            
            
        }