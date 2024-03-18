<?php
declare(strict_types=1);

namespace App\UI\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\UI\Form\Model\SearchPoints as SearchPointsModel;
use App\UI\Form\DataTransformer\CapitalizeTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SearchPoints extends AbstractType
{
    public function __construct(private CapitalizeTransformer $capitalizeTransformer)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, ['required' => false])
            ->add('city', TextType::class)
            ->add('postCode', TextType::class, ['required' => false])
            ->add('save', SubmitType::class)
        ;
        $builder->get('city')->addModelTransformer($this->capitalizeTransformer);
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();
            
            if (\is_array($data) && \array_key_exists('postCode', $data) && $data['postCode'] === '01-234') {
                $form->add('name', TextType::class, ['required' => false]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchPointsModel::class,
            'allow_extra_fields' => true,
        ]);
    }
}