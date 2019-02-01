<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{  
    
    /**
    *  
    *
    * @Route("/create", options={"expose"=true}, name="user_create") 
    */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isXmlHttpRequest()){
           
                $data = json_decode(
                    $request->getContent(),
                    true
                );
           
            $userName = $data["userName"];
            $userEmail = $data["userEmail"];
            $userPassword = $data["userPassword"];
            
            $name_check = $this->getDoctrine()
            ->getRepository(User::class)
            ->findUsername($userName);


            if($name_check) {
                $data = "Ce nom d'utilisateur est déjà pris, veuillez en saisir un nouveau";
                return new JsonResponse($data); 
            
            }else {
                $entityManager = $this->getDoctrine()->getManager();
                $user = new User();
                
                $user->setUserName($userName);
                $user->setEmail($userEmail);
                $user->setPlainPassword($userPassword);
                $userPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($userPassword);
                // creates a task and gives it some dummy data for this example
                
                $entityManager->persist($user);
                $entityManager->flush();
                /* $lastId = $user->getId();
                $data["id"] = $lastId; */
            }
            $data = "Félicitation votre inscription a bien été prise en compte. Vous pouvez vous connecter grâce au formulaire situé à votre gauche";
            return new JsonResponse($data); 
        }
    }
    
    
    
     /**
    * Matches /
    * @Route("/", name="user_log")
    */
    
    /*
    public function log(Request $request){
        
        if ($request->isXmlHttpRequest()){
            
            $data = json_decode(
                $request->getContent(),
                true
            );

            $name_check = $this->getDoctrine()
            ->getRepository(User::class)
            ->findUsername($userName);


            $userName = $data["userName"];
            $userPassword = $data["userPassword"];
            $task = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($userName);
        }
        return $this->render('user/con_inscr.html.twig');
        
        
        
        
    } */
    
    
    
}


