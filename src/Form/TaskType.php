<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 

use App\Entity\Task;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('task', TextType::class, ['attr' => ['maxlenght' => 20, 'class' => 'listeTask', 'placeholder' => 'Nom de la tâche']])
        ->add('dueDate', DateType::class, ['widget'=> 'single_text','label'=>'Quand doit-être finis la tâche ?'])
        ->add('agreeTerms', CheckboxType::class, ['mapped' => false])
        ->add('save', SubmitType::class, ['label' => 'Create Task']);
        
        
    }

    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Task::class,
    ]);
}
}