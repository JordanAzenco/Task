<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id_task")
     */
    private $id;


    
      /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, name="TaskName")
     */
    public $task;



    
   

     /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime", name="TaskDate")
     */
    public $dueDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="tasks")
    *   @ORM\JoinTable(name="task_user",
     *      joinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id_task")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id_user")}
     *      )
     */
    private $users;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }


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

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }
}
