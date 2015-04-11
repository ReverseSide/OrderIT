<?php

namespace OrderIT\Bundle\OrderBundle\Form;

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
            ->add('numeroDemand')
            ->add('projectProject')
            ->add('deliveryDelivery')
            ->add('vendorVendor')
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
            #->add('statusstatus')
            #->add('creaIdUser')
            #->add('validRespIdUser')
            #->add('validAccouIdUser')
            #->add('creaDemand')
            #->add('modDemand')
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
