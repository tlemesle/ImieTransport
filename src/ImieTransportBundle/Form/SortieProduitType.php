<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 25/10/17
 * Time: 11:26
 */

namespace ImieTransportBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ImieTransportBundle\Entity\Produit;

class SortieProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit',EntityType::class, array(
                'class' => Produit::class,
                'multiple' => false,
                'expanded' => false
            ))
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('quantite', IntegerType::class,array(
                'attr' => array('min' => 1)))
            ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ImieTransportBundle\Entity\SortieProduit'
        ));
    }
}