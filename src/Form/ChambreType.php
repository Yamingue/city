<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,[
                'label'=>'Nom ou numero de la chambre',
                'attr'=>[
                    'placeholder'=>'ex: B1, 12, A0'
                ]
            ])
            ->add('Cuisine',ChoiceType::class,[
                'label'=>'La chambre Pocède une cuisine interne',
                'choices'=>[
                    'Non'=>false,
                    'Oui'=>true
                ]
            ])
            ->add('type')
            ->add('description')
            ->add('poster',FileType::class,[
                'constraints'=>[
                    new Image()
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
