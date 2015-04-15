<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendor
 *
 * @ORM\Table(name="vendor")
 * @ORM\Entity
 */
class Vendor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_vendor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVendor;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="postofficebox", type="integer", nullable=true)
     */
    private $postofficebox;

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
     * @ORM\Column(name="locality", type="string", length=45, nullable=true)
     */

    private $locality;

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
     * Get idVendor
     *
     * @return integer 
     */
    public function getIdVendor()
    {
        return $this->idVendor;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Vendor
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
     * Set postofficebox
     *
     * @param integer $postofficebox
     * @return Vendor
     */
    public function setPostofficebox($postofficebox)
    {
        $this->postofficebox = $postofficebox;

        return $this;
    }

    /**
     * Get postofficebox
     *
     * @return integer 
     */
    public function getPostofficebox()
    {
        return $this->postofficebox;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Vendor
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
     * @return Vendor
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
     * Set locality
     *
     * @param string $locality
     * @return Vendor
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string
     */
    public function getlocality()
    {
        return $this->locality;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     * @return Vendor
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
     * @return Vendor
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
