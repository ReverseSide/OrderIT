<?php

namespace OrderIT\Bundle\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VendorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('postofficebox')
            ->add('adress')
            ->add('postcode')
            ->add('telephone')
            ->add('fax')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrderIT\Bundle\OrderBundle\Entity\Vendor'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orderit_bundle_orderbundle_vendor';
    }
}
