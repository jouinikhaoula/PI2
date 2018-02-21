<?php
/**
 * Created by PhpStorm.
 * User: Narjes
 * Date: 2/20/2018
 * Time: 10:47 PM
 */

namespace AllForKids\MainBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercherType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('categorie')
            ->add('Rechercher',SubmitType::class);


    }





}