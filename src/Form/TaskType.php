<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
            'label' => 'Title: ' 
        ))
        ->add('content', TextareaType::class, array(
            'label' => 'Content: ' 
        ))
        ->add('priority', ChoiceType::class, array(
            'label' => 'Priority: ',
            'choices' => [
                'high' => 'Hight',
                'medium' => 'Medium',
                'low' => 'Low'
             ] 
        ))
        ->add('time', TextType::class, array(
            'label' => 'Time: ' 
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Save' 
        ));
    }
}