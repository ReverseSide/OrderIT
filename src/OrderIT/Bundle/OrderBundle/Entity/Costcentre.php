<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Costcentre
 *
 * @ORM\Table(name="costcentre", uniqueConstraints={@ORM\UniqueConstraint(name="costcentre_UNIQUE", columns={"costcentre"})})
 * @ORM\Entity
 */
class Costcentre
{
    public function __toString() {
        return $this->getCostcentre();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_costcentre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCostcentre;

    /**
     * @var string
     *
     * @ORM\Column(name="costcentre", type="string", length=3, nullable=false)
     */
    private $costcentre;



    /**
     * Get idCostcentre
     *
     * @return integer 
     */
    public function getIdCostcentre()
    {
        return $this->idCostcentre;
    }

    /**
     * Set costcentre
     *
     * @param string $costcentre
     * @return Costcentre
     */
    public function setCostcentre($costcentre)
    {
        $this->costcentre = $costcentre;

        return $this;
    }

    /**
     * Get costcentre
     *
     * @return string 
     */
    public function getCostcentre()
    {
        return $this->costcentre;
    }
}
