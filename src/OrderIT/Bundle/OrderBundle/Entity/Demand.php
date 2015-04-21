<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Demand
 *
 * @ORM\Table(name="demand", indexes={@ORM\Index(name="fk_order_vendor_idx", columns={"vendor_id_vendor"}), @ORM\Index(name="fk_order_delivery1_idx", columns={"delivery_id_delivery"}), @ORM\Index(name="fk_order_status1_idx", columns={"status_idstatus"}), @ORM\Index(name="fk_demand_costcentre1_idx", columns={"costcentre_id_costcentre"}), @ORM\Index(name="fk_demand_proco1_idx", columns={"proco_id_proco"}), @ORM\Index(name="fk_demand_oracle1_idx", columns={"oracle_id_oracle"}), @ORM\Index(name="fk_demand_project1_idx", columns={"project_id_project"}), @ORM\Index(name="fk_demand_sector1_idx", columns={"sector_id_sector"}), @ORM\Index(name="fk_demand_labo1_idx", columns={"labo_id_labo"}), @ORM\Index(name="fk_demand_reference1_idx", columns={"reference_id_reference"})})
 * @ORM\Entity
 */
class Demand
{
    public function __toString() {

        return $this->getIdDemand();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_demand", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemand;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_demand", type="decimal", precision=8, scale=0, nullable=false)
     */
    private $numeroDemand;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reference_date", type="date", nullable=true)
     */
    private $referenceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="text", nullable=true)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="Hfield", type="string", length=1, nullable=true)
     */
    private $hfield;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=8, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var integer
     *
     * @ORM\Column(name="localuser_crea_id_user", type="integer", nullable=false)
     */
    private $creaIdUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="localuser_resp_id_user", type="integer", nullable=true)
     */
    private $validRespIdUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="localuser_acc_id_user", type="integer", nullable=true)
     */
    private $validAccouIdUser;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="crea_demand", type="datetime", nullable=true)
     */
    private $creaDemand;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable
     * @ORM\Column(name="mod_demand", type="datetime", nullable=true)
     */
    private $modDemand;

    /**
     * @var \Costcentre
     *
     * @ORM\ManyToOne(targetEntity="Costcentre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="costcentre_id_costcentre", referencedColumnName="id_costcentre")
     * })
     */
    private $costcentreCostcentre;

    /**
     * @var \Labo
     *
     * @ORM\ManyToOne(targetEntity="Labo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="labo_id_labo", referencedColumnName="id_labo")
     * })
     */
    private $laboLabo;

    /**
     * @var \Oracle
     *
     * @ORM\ManyToOne(targetEntity="Oracle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="oracle_id_oracle", referencedColumnName="id_oracle")
     * })
     */
    private $oracleOracle;

    /**
     * @var \Proco
     *
     * @ORM\ManyToOne(targetEntity="Proco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proco_id_proco", referencedColumnName="id_proco")
     * })
     */
    private $procoProco;

    /**
     * @var \Project
     *
     * @ORM\ManyToOne(targetEntity="Project",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id_project", referencedColumnName="id_project")
     * })
     */
    private $projectProject;

    /**
     * @var \Reference
     *
     * @ORM\ManyToOne(targetEntity="Reference")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reference_id_reference", referencedColumnName="id_reference")
     * })
     */
    private $referenceReference;

    /**
     * @var \Sector
     *
     * @ORM\ManyToOne(targetEntity="Sector")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sector_id_sector", referencedColumnName="id_sector")
     * })
     */
    private $sectorSector;

    /**
     * @var \Delivery
     *
     * @ORM\ManyToOne(targetEntity="Delivery",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="delivery_id_delivery", referencedColumnName="id_delivery")
     * })
     */
    private $deliveryDelivery;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_idstatus", referencedColumnName="id_status")
     * })
     */
    private $statusstatus;

    /**
     * @var \Vendor
     *
     * @ORM\ManyToOne(targetEntity="Vendor",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendor_id_vendor", referencedColumnName="id_vendor")
     * })
     */
    private $vendorVendor;



    /**
     * Get idDemand
     *
     * @return integer 
     */
    public function getIdDemand()
    {
        return $this->idDemand;
    }

    /**
     * Set numeroDemand
     *
     * @param string $numeroDemand
     * @return Demand
     */
    public function setNumeroDemand($numeroDemand)
    {
        $this->numeroDemand = $numeroDemand;

        return $this;
    }

    /**
     * Get numeroDemand
     *
     * @return string 
     */
    public function getNumeroDemand()
    {
        return $this->numeroDemand;
    }

    /**
     * Set referenceDate
     *
     * @param \DateTime $referenceDate
     * @return Demand
     */
    public function setReferenceDate($referenceDate)
    {
        $this->referenceDate = $referenceDate;

        return $this;
    }

    /**
     * Get referenceDate
     *
     * @return \DateTime 
     */
    public function getReferenceDate()
    {
        return $this->referenceDate;
    }

    /**
     * Set observation
     *
     * @param string $observation
     * @return Demand
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string 
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set hfield
     *
     * @param string $hfield
     * @return Demand
     */
    public function setHfield($hfield)
    {
        $this->hfield = $hfield;

        return $this;
    }

    /**
     * Get hfield
     *
     * @return string 
     */
    public function getHfield()
    {
        return $this->hfield;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Demand
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set creaIdUser
     *
     * @param integer $creaIdUser
     * @return Demand
     */
    public function setCreaIdUser($creaIdUser)
    {
        $this->creaIdUser = $creaIdUser;

        return $this;
    }

    /**
     * Get creaIdUser
     *
     * @return integer 
     */
    public function getCreaIdUser()
    {
        return $this->creaIdUser;
    }

    /**
     * Set validRespIdUser
     *
     * @param integer $validRespIdUser
     * @return Demand
     */
    public function setValidRespIdUser($validRespIdUser)
    {
        $this->validRespIdUser = $validRespIdUser;

        return $this;
    }

    /**
     * Get validRespIdUser
     *
     * @return integer 
     */
    public function getValidRespIdUser()
    {
        return $this->validRespIdUser;
    }

    /**
     * Set validAccouIdUser
     *
     * @param integer $validAccouIdUser
     * @return Demand
     */
    public function setValidAccouIdUser($validAccouIdUser)
    {
        $this->validAccouIdUser = $validAccouIdUser;

        return $this;
    }

    /**
     * Get validAccouIdUser
     *
     * @return integer 
     */
    public function getValidAccouIdUser()
    {
        return $this->validAccouIdUser;
    }

    /**
     * Set creaDemand
     *
     * @param \DateTime $creaDemand
     * @return Demand
     */
    public function setCreaDemand($creaDemand)
    {
        $this->creaDemand = $creaDemand;

        return $this;
    }

    /**
     * Get creaDemand
     *
     * @return \DateTime 
     */
    public function getCreaDemand()
    {
        return $this->creaDemand;
    }

    /**
     * Set modDemand
     *
     * @param \DateTime $modDemand
     * @return Demand
     */
    public function setModDemand($modDemand)
    {
        $this->modDemand = $modDemand;

        return $this;
    }

    /**
     * Get modDemand
     *
     * @return \DateTime 
     */
    public function getModDemand()
    {
        return $this->modDemand;
    }

    /**
     * Set costcentreCostcentre
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Costcentre $costcentreCostcentre
     * @return Demand
     */
    public function setCostcentreCostcentre(\OrderIT\Bundle\OrderBundle\Entity\Costcentre $costcentreCostcentre = null)
    {
        $this->costcentreCostcentre = $costcentreCostcentre;

        return $this;
    }

    /**
     * Get costcentreCostcentre
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Costcentre 
     */
    public function getCostcentreCostcentre()
    {
        return $this->costcentreCostcentre;
    }

    /**
     * Set laboLabo
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Labo $laboLabo
     * @return Demand
     */
    public function setLaboLabo(\OrderIT\Bundle\OrderBundle\Entity\Labo $laboLabo = null)
    {
        $this->laboLabo = $laboLabo;

        return $this;
    }

    /**
     * Get laboLabo
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Labo 
     */
    public function getLaboLabo()
    {
        return $this->laboLabo;
    }

    /**
     * Set oracleOracle
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Oracle $oracleOracle
     * @return Demand
     */
    public function setOracleOracle(\OrderIT\Bundle\OrderBundle\Entity\Oracle $oracleOracle = null)
    {
        $this->oracleOracle = $oracleOracle;

        return $this;
    }

    /**
     * Get oracleOracle
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Oracle 
     */
    public function getOracleOracle()
    {
        return $this->oracleOracle;
    }

    /**
     * Set procoProco
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Proco $procoProco
     * @return Demand
     */
    public function setProcoProco(\OrderIT\Bundle\OrderBundle\Entity\Proco $procoProco = null)
    {
        $this->procoProco = $procoProco;

        return $this;
    }

    /**
     * Get procoProco
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Proco 
     */
    public function getProcoProco()
    {
        return $this->procoProco;
    }

    /**
     * Set projectProject
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Project $projectProject
     * @return Demand
     */
    public function setProjectProject(\OrderIT\Bundle\OrderBundle\Entity\Project $projectProject = null)
    {
        $this->projectProject = $projectProject;

        return $this;
    }

    /**
     * Get projectProject
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Project 
     */
    public function getProjectProject()
    {
        return $this->projectProject;
    }

    /**
     * Set referenceReference
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Reference $referenceReference
     * @return Demand
     */
    public function setReferenceReference(\OrderIT\Bundle\OrderBundle\Entity\Reference $referenceReference = null)
    {
        $this->referenceReference = $referenceReference;

        return $this;
    }

    /**
     * Get referenceReference
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Reference 
     */
    public function getReferenceReference()
    {
        return $this->referenceReference;
    }

    /**
     * Set sectorSector
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Sector $sectorSector
     * @return Demand
     */
    public function setSectorSector(\OrderIT\Bundle\OrderBundle\Entity\Sector $sectorSector = null)
    {
        $this->sectorSector = $sectorSector;

        return $this;
    }

    /**
     * Get sectorSector
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Sector 
     */
    public function getSectorSector()
    {
        return $this->sectorSector;
    }

    /**
     * Set deliveryDelivery
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Delivery $deliveryDelivery
     * @return Demand
     */
    public function setDeliveryDelivery(\OrderIT\Bundle\OrderBundle\Entity\Delivery $deliveryDelivery = null)
    {
        $this->deliveryDelivery = $deliveryDelivery;

        return $this;
    }

    /**
     * Get deliveryDelivery
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Delivery 
     */
    public function getDeliveryDelivery()
    {
        return $this->deliveryDelivery;
    }

    /**
     * Set statusstatus
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Status $statusstatus
     * @return Demand
     */
    public function setStatusstatus(\OrderIT\Bundle\OrderBundle\Entity\Status $statusstatus)
    {
        $this->statusstatus = $statusstatus;

        return $this;
    }

    /**
     * Get statusstatus
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Status 
     */
    public function getStatusstatus()
    {
        return $this->statusstatus;
    }

    /**
     * Set vendorVendor
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Vendor $vendorVendor
     * @return Demand
     */
    public function setVendorVendor(\OrderIT\Bundle\OrderBundle\Entity\Vendor $vendorVendor = null)
    {
        $this->vendorVendor = $vendorVendor;

        return $this;
    }

    /**
     * Get vendorVendor
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Vendor
     */
    public function getVendorVendor()
    {
        return $this->vendorVendor;
    }

}
