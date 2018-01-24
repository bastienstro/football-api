<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('country')
            ->add('age')
            ->add('position')
            ->add('height')
            ->add('weight')
            ->add('rightFoot')
          
        ;
    }
    public function getName()
	{
		return '';
	}
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ApiBundle\Entity\Player'
            ,'cascade_validation' => true,'csrf_protection' => false,
        ));
    }
    
    }
