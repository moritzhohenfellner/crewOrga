<?php

namespace App\Form;

use App\Entity\Toern;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ToernType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromDate', DateType::class, array('widget' => 'single_text', 'label' => 'Von', 'html5' => false, 'attr' => ['class' => 'js-datepicker']))
            ->add('toDate', DateType::class, array('widget' => 'single_text', 'label' => 'Bis', 'html5' => false, 'attr' => ['class' => 'js-datepicker']))
            ->add('Destination', TextType::class, array('label' => 'Fahrtgebiet'))
            ->add('save', SubmitType::class, array('label' => 'Törn anlegen'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Toern::class,
        ]);
    }
}
