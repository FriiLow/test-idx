<?php

namespace App\Form;

use App\Entity\StaplingConfig;
use App\Entity\StaplingRule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaplingRuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('glueOperator')
            ->add('comparisonOperator')
            ->add('value')
            ->add('metadataEnum')
            ->add('staplingConfig', EntityType::class, [
                'class' => StaplingConfig::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StaplingRule::class,
        ]);
    }
}
