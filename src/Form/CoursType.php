<?php
    namespace App\Form;
    use App\Entity\Cours; use Symfony\Component\Form\AbstractType; use
    Symfony\Component\Form\Extension\Core\Type\TextType; use Symfony\Component\Form\Extension\Core\Type\SubmitType; use
    Symfony\Component\Form\FormBuilderInterface; use Symfony\Component\OptionsResolver\OptionsResolver; class CoursType
    extends AbstractType { public function buildForm(FormBuilderInterface $builder, array $options) { $builder ->
    add('name', TextType::class, [
    'label' => 'Nom du Cours',
    ])
    ->add('save', SubmitType::class, [
    'label' => 'Créer Cours'
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults([
    'data_class' => Cours::class,
    ]);
    }
    }