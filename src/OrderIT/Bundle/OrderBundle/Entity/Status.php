<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status", uniqueConstraints={@ORM\UniqueConstraint(name="description_UNIQUE", columns={"description"})})
 * @ORM\Entity
 */
class Status
{
    public function __toString() {
        return $this->getDescription();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_status", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=false)
     */
    private $description;



    /**
     * Get idStatus
     *
     * @return integer 
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Status
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
}
