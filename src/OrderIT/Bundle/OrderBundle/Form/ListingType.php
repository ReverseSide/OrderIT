<?php

namespace OrderIT\Bundle\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demandDemand', new DemandType())
            ->add('articleArticle', 'collection', array(
               'type' => new ArticleType(),
               'allow_add' => true,
               'by_reference' => false,))
            ->add('modifier', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrderIT\Bundle\OrderBundle\Entity\Listing'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orderit_bundle_orderbundle_listing';
    }
}
