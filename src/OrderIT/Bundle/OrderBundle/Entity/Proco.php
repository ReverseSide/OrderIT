<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proco
 *
 * @ORM\Table(name="proco", uniqueConstraints={@ORM\UniqueConstraint(name="proco_UNIQUE", columns={"proco"})})
 * @ORM\Entity
 */
class Proco
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_proco", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProco;

    /**
     * @var string
     *
     * @ORM\Column(name="proco", type="string", length=8, nullable=false)
     */
    private $proco;



    /**
     * Get idProco
     *
     * @return integer 
     */
    public function getIdProco()
    {
        return $this->idProco;
    }

    /**
     * Set proco
     *
     * @param string $proco
     * @return Proco
     */
    public function setProco($proco)
    {
        $this->proco = $proco;

        return $this;
    }

    /**
     * Get proco
     *
     * @return string 
     */
    public function getProco()
    {
        return $this->proco;
    }
}
