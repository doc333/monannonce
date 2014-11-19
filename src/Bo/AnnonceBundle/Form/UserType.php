<?php
namespace Bo\AnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array(
           'first_name' => 'password',
           'second_name' => 'confirm',
           'type' => 'password',
        ));
        $builder->add('nom', 'text');
        $builder->add('prenom', 'text'); 
        $builder->add('cp', 'integer');
        $builder->add('ville', 'text');
        $builder->add('is_newsletter', 'checkbox', array('property_path' => 'is_newsletter'));
        $builder->add('is_desactiver', 'hidden', array('data' => 0));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bo\AnnonceBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }

}