<?php
namespace Bo\AnnonceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Iban;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('civilite', 'choice',array(
            'choices' => array(
                'Mr' => "Mr",
                'Mme'=> "Mme"
            ),
            'expanded' => true,
            'multiple' => false,
            'label'    => 'Civilité',
            'constraints' => array(
                new NotBlank(),
            ),
        ));
        $builder->add('nom', 'text', array(
            'label' => 'Nom',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('prenom', 'text', array(
            'label' => 'Prénom',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('email', 'email', array(
            'label' => 'Email',
            'constraints' => array(
                new NotBlank(),
                new Email()
            ),
        ));
        $builder->add('message', 'textarea', array(
            'label' => 'Message',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 5)),
            ),
        ));
        $builder->add('fileImgUpload', 'file', array(
            'label' => 'Fichier joint',
            'constraints' => array(
                new Image()
            ),
        ));
        $builder->add('fileImgUpload2', 'file', array(
            'label' => 'Fichier joint 2',
            'constraints' => array(
                new Image()
            ),
        ));
        $builder->add('submit', 'submit');
    }

    public function getName()
    {
        return 'contact';
    }
}