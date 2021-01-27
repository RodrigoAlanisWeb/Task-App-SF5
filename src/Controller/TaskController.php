<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskController extends AbstractController
{
    #[Route('/', name: 'tasks')]
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repo->findAll();

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'tasks' => $tasks
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(Task $task)
    {
        if (!$task) {
            return $this->redirectToRoute('tasks'); 
        }

        return $this->render('task/detail.html.twig',[
            'task' => $task,
        ]);
    }
    #[Route('/create', name:'create')]
    public function create(Request $request,UserInterface $user) 
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime();
            $date->format('d-m-y H:i:s');
            $task->setCreatedAt($date);
            $task->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('tasks');
        }

        return $this->render('task/create.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/my-tasks',name:'my-tasks')]
    public function myTasks(UserInterface $user)
    {
        $tasks = $user->getTasks();

        return $this->render('task/my-tasks.html.twig',[
            'tasks' => $tasks
        ]);
    }

    #[Route('/edit/{id}',name:'edit')]
    public function edit(Request $request, Task $task, UserInterface $user)
    {
        if (!$user || $user->getId() != $task->getUser()->getId()) {
            return $this->redirectToRoute('tasks');
        }

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('detail',["id"=>$task->getId()]);
        }

        return $this->render('task/create.html.twig',[
            'edit' => true,
            'task' => $task,
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}',name:'delete')]
    public function delete(Task $task, UserInterface $user)
    {
        if (!$user || $user->getId() != $task->getUser()->getId()) {
            return $this->redirectToRoute('tasks');
        }

        if ($task) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }
        
        return $this->redirectToRoute('tasks');
    }
}
