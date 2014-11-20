<?php
namespace Bo\AnnonceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Image;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('avatar', 'file', array(
            'label' => 'Avatar',
            'constraints' => array(
                new Image()
            ),
        ));
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
        $builder->add('departement', 'entity', array(
            'class'     => 'BoAnnonceBundle:Departement',
            'property'  => 'code',
            'multiple'  => true
        ));
        $builder->add('role', 'entity', array(
            'class'     => 'BoAnnonceBundle:Role',
            'property'  => 'role',
            'multiple'  => true
        ));
        $builder->add('is_newsletter', 'checkbox', array(
            'label'     => 'Abonnement à la newsletter',
            'required'  => false,
        ));
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