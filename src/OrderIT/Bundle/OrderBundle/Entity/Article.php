<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    public function __toString() {

        return (string) $this->getIdArticle();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_article", type="string", length=45, nullable=true)
     */
    private $numeroArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=145, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Listing", mappedBy="articleArticle")
     */
    private $listingListing;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listingListing = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idArticle
     *
     * @return integer 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set numeroArticle
     *
     * @param string $numeroArticle
     * @return Article
     */
    public function setNumeroArticle($numeroArticle)
    {
        $this->numeroArticle = $numeroArticle;

        return $this;
    }

    /**
     * Get numeroArticle
     *
     * @return string
     */
    public function getNumeroArticle()
    {
        return $this->numeroArticle;
    }


    /**
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Article
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Add listingListing
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing
     * @return Article
     */
    public function addListingListing(\OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing)
    {
        $this->listingListing[] = $listingListing;

        return $this;
    }

    /**
     * Remove listingListing
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing
     */
    public function removeListingListing(\OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing)
    {
        $this->listingListing->removeElement($listingListing);
    }

    /**
     * Get listingListing
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListingListing()
    {
        return $this->listingListing;
    }
}
