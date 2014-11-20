<?php
namespace Bo\AnnonceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('annonceType', 'entity', array(
            'class'     => 'BoAnnonceBundle:AnnonceType',
            'property'  => 'nom',
            'multiple'  => false
        ));
        $builder->add('titre', 'text', array(
            'label' => 'Titre',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('description', 'text', array(
            'label' => 'Description',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('nbrPlace', 'integer', array(
            'label' => 'Nombre de places',
            'constraints' => array(
                new Range(array(
                    'min' => 0,
                    'max' => 10000,
                    'minMessage' => 'Le nombre de places doit être supérieur à 0',
                    'maxMessage' => 'Le nombre de places ne peut pas dépacer 10000',
                )),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('isActive', 'checkbox', array(
            'label'     => 'Activer',
            'required'  => false,
        ));
        $builder->add('isRefuser', 'hidden', array('data' => 1));
        $builder->add('adresse', 'text', array(
            'label' => 'Adresse',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('cp', 'integer', array(
            'label' => 'Code postal',
            'constraints' => array(
                new Range(array(
                    'min' => 10000,
                    'max' => 100000,
                    'minMessage' => 'Le code postale est incorect',
                    'maxMessage' => 'Le code postale est incorect',
                )),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('ville', 'text', array(
            'label' => 'Ville',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)),
            ),
        ));
        $builder->add('dateDebut', 'text', array(
            'label' => 'Date de début',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 8)),
            ),
        ));
        $builder->add('dateFin', 'text', array(
            'label' => 'Date de fin',
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 8)),
            ),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bo\AnnonceBundle\Entity\Annonce'
        ));
    }

    public function getName()
    {
        return 'annonce';
    }

}