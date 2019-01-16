<?php

namespace AppBundle\Form;

use AppBundle\Entity\SubFamily;
use AppBundle\Repository\SubFamilyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name')
            ->add('subFamily', EntityType::class,
                [
                    'placeholder' => 'Choose a sub-family',
                    'class' => SubFamily::class,
                    'query_builder' => function(SubFamilyRepository $repository)
                    {
                        return $repository->createAlphabeticalQueryBuilder();
                    }
                ])
            ->add('speciesCount')
            ->add('funFact')
            ->add('isPublished', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                [
                    'choices' =>
                        [
                    'Yes' => true,
                    'No' => false,
                        ]
                ])
            ->add('firstDiscoveredAt', 'Symfony\Component\Form\Extension\Core\Type\DateType',
                [
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'js-datepicker'
                    ],
                    'html5' => false,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Genus'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_genus_form_type';
    }
}
