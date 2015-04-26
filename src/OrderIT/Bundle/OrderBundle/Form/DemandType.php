<?php

namespace OrderIT\Bundle\OrderBundle\Form;

use OrderIT\Bundle\OrderBundle\Entity\Delivery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class DemandType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder

            ->add('projectProject', new ProjectType())
            ->add('numberclient')
            ->add('deliveryDelivery', new DeliveryType())
            ->add('vendorVendor', new VendorType())
            ->add('referenceReference')
            ->add('referenceDate')
            ->add('observation')
            ->add('hfield')
            ->add('amount')
            ->add('costcentreCostcentre')
            ->add('laboLabo')
            ->add('oracleOracle')
            ->add('procoProco')
            ->add('sectorSector')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrderIT\Bundle\OrderBundle\Entity\Demand',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orderit_bundle_orderbundle_demand';
    }
}
