<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;




/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id_task")
     */
    private $id;


    /**
     * @Assert\NotBlank
     */
      /**
     * @ORM\Column(type="string", length=255, name="TaskName")
     */
    public $task;



    
    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */

     /**
     * @ORM\Column(type="datetime", name="TaskDate")
     */
    public $dueDate;


    public function getId()
    {
        return $this->id;
    }

    public function setTid($id)
    {
        $this->id = $id;
    }


    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }
}
