<?php

namespace App\Form;

use App\Entity\StaplingConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaplingConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug', TextType::class);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var StaplingConfig|null $data */
            $data = $event->getData();
            $form = $event->getForm();

            $config = $data?->getContainer()?->getConfig() ?? [];

            $form->add('rules', CollectionType::class, [
                'entry_type' => StaplingRuleType::class,
                'entry_options' => [
                    'label' => false,
                    'config' => $config,
                    'attr' => [
                        'data-form-collection-target' => 'rule',
                    ],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StaplingConfig::class,
        ]);
    }
}
