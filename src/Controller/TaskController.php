<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'task')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        // $task_repo = $this->getDoctrine()->getRepository(Task::class);

        // $tasks = $task_repo->findAll();

        // foreach($tasks as $task) {
        //     echo $task->getUser()->getEmail() . ' : ' . $task->getTitle() . '<br>';
        // }

        $user_repo = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $user_repo->findAll();
        foreach($users as $user) {
                echo $user->getName() . ' ' . $user->getSurname() . '<br>';
                foreach($user->getTasks() as $task) {
                    echo $task->getUser()->getEmail() . ' : ' . $task->getTitle() . '<br>';
                }
        }

        

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
