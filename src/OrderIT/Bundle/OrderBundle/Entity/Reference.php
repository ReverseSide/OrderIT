<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reference
 *
 * @ORM\Table(name="reference", uniqueConstraints={@ORM\UniqueConstraint(name="reference_UNIQUE", columns={"reference"})})
 * @ORM\Entity
 */
class Reference
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reference", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReference;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=45, nullable=false)
     */
    private $reference;



    /**
     * Get idReference
     *
     * @return integer 
     */
    public function getIdReference()
    {
        return $this->idReference;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }
}
