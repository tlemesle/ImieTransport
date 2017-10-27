<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 25/10/17
 * Time: 00:38
 */

namespace ImieTransportBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ImieTransportBundle\Entity\Rayon;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('description', TextareaType::class)
            ->add('stock',IntegerType::class)
            ->add('limiteStock',IntegerType::class)
            ->add('alertMail', ChoiceType::class, array(
                'choices' => array(
                    'Oui' => "1",
                    'Non' => "0"
                ),
                'required' => true,
                'empty_data' => false,
                'choices_as_values' => true
            ))
            ->add('rayon',EntityType::class, array(
                'class' => Rayon::class,
                'multiple' => false,
                'expanded' => true
            ))
            ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ImieTransportBundle\Entity\Produit'
        ));
    }
}