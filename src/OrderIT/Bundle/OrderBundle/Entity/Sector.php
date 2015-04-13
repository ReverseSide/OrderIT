<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="sector", uniqueConstraints={@ORM\UniqueConstraint(name="sector_UNIQUE", columns={"sector"})})
 * @ORM\Entity
 */
class Sector
{
    public function __toString() {
        return $this->getSector();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sector", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSector;

    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="string", length=3, nullable=false)
     */
    private $sector;



    /**
     * Get idSector
     *
     * @return integer 
     */
    public function getIdSector()
    {
        return $this->idSector;
    }

    /**
     * Set sector
     *
     * @param string $sector
     * @return Sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string 
     */
    public function getSector()
    {
        return $this->sector;
    }
}
