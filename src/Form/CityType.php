<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Image;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,[
                'label'=>'Nom de la cité'
                ])
            ->add('commentaire',TextareaType::class,[
                'label'=>'Nom de la cité',
                'attr'=>['placeholder'=>'Parler de votre cité sa localisation par raport a l\'université et tous ce qui est necessaire a savoir.']
                ])
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
            'data_class' => City::class,
        ]);
    }
}
