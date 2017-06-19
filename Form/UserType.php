<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',   TextType::class, array('required' => false))
            ->add('firstname',  TextType::class, array('required' => false))
            ->add('lastname',   TextType::class, array('required' => false))
            ->add('birthday',   BirthdayType::class, array('required' => false));

            if (in_array('ROLE_SUPER_ADMIN', $options['role']))
            {
                $builder
                    ->add('credit',  NumberType::class, array('required' => false, 'scale' => 2))
                    ->add('premiumEnd', DateType::class, array('required' => false));
            }
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'role'       => ['ROLE_USER']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user';
    }
}
