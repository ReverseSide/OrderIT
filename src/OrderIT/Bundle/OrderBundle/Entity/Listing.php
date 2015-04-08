<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Listing
 *
 * @ORM\Table(name="listing", indexes={@ORM\Index(name="fk_list_order1_idx", columns={"demand_id_demand"})})
 * @ORM\Entity
 */
class Listing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_listing", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idListing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="crea_listing", type="datetime", nullable=true)
     */
    private $creaListing;

    /**
     * @var \Demand
     *
     * @ORM\ManyToOne(targetEntity="Demand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demand_id_demand", referencedColumnName="id_demand")
     * })
     */
    private $demandDemand;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="listingListing")
     * @ORM\JoinTable(name="listing_has_article",
     *   joinColumns={
     *     @ORM\JoinColumn(name="listing_id_listing", referencedColumnName="id_listing")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="article_id_article", referencedColumnName="id_article")
     *   }
     * )
     */
    private $articleArticle;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articleArticle = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idListing
     *
     * @return integer 
     */
    public function getIdListing()
    {
        return $this->idListing;
    }

    /**
     * Set creaListing
     *
     * @param \DateTime $creaListing
     * @return Listing
     */
    public function setCreaListing($creaListing)
    {
        $this->creaListing = $creaListing;

        return $this;
    }

    /**
     * Get creaListing
     *
     * @return \DateTime 
     */
    public function getCreaListing()
    {
        return $this->creaListing;
    }

    /**
     * Set demandDemand
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Demand $demandDemand
     * @return Listing
     */
    public function setDemandDemand(\OrderIT\Bundle\OrderBundle\Entity\Demand $demandDemand = null)
    {
        $this->demandDemand = $demandDemand;

        return $this;
    }

    /**
     * Get demandDemand
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Demand 
     */
    public function getDemandDemand()
    {
        return $this->demandDemand;
    }

    /**
     * Add articleArticle
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Article $articleArticle
     * @return Listing
     */
    public function addArticleArticle(\OrderIT\Bundle\OrderBundle\Entity\Article $articleArticle)
    {
        $this->articleArticle[] = $articleArticle;

        return $this;
    }

    /**
     * Remove articleArticle
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Article $articleArticle
     */
    public function removeArticleArticle(\OrderIT\Bundle\OrderBundle\Entity\Article $articleArticle)
    {
        $this->articleArticle->removeElement($articleArticle);
    }

    /**
     * Get articleArticle
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticleArticle()
    {
        return $this->articleArticle;
    }
}
