<?php declare(strict_types=1);

namespace App\UI\Backend\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


final class AccountEditForm extends AbstractType
{
    //========================================================================================================
    // Form definition
    //========================================================================================================
    
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder->add('forename', TextType::class, [
            'label' => 'entities.account.forename.label',
            'required' => true,
            'empty_data' => '',
        ]);
        $builder->add('lastname', TextType::class, [
            'label' => 'entities.account.lastname.label',
            'required' => true,
            'empty_data' => '',
        ]);
        $builder->add('email', TextType::class, [
            'label' => 'entities.account.email.label',
            'required' => true,
            'empty_data' => '',
        ]);
    }
    
    
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => AccountEditFormData::class,
        ]);
    }
    
    
    
}
