<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table(name="delivery")
 * @ORM\Entity
 */
class Delivery
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_delivery", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDelivery;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="postoffice", type="integer", nullable=true)
     */
    private $postoffice;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=45, nullable=false)
     */
    private $adress;

    /**
     * @var integer
     *
     * @ORM\Column(name="postcode", type="integer", nullable=false)
     */
    private $postcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", nullable=true)
     */
    private $fax;

    public function __toString(){
        return $this->getName();
    }

    /**
     * Get idDelivery
     *
     * @return integer
     */


    public function getIdDelivery()
    {
        return $this->idDelivery;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Delivery
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set postoffice
     *
     * @param integer $postoffice
     * @return Delivery
     */
    public function setPostoffice($postoffice)
    {
        $this->postoffice = $postoffice;

        return $this;
    }

    /**
     * Get postoffice
     *
     * @return integer 
     */
    public function getPostoffice()
    {
        return $this->postoffice;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Delivery
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     * @return Delivery
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return integer 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     * @return Delivery
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     * @return Delivery
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }
}
