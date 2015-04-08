<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labo
 *
 * @ORM\Table(name="labo", uniqueConstraints={@ORM\UniqueConstraint(name="labo_UNIQUE", columns={"labo"})})
 * @ORM\Entity
 */
class Labo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_labo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLabo;

    /**
     * @var string
     *
     * @ORM\Column(name="labo", type="string", length=3, nullable=false)
     */
    private $labo;



    /**
     * Get idLabo
     *
     * @return integer 
     */
    public function getIdLabo()
    {
        return $this->idLabo;
    }

    /**
     * Set labo
     *
     * @param string $labo
     * @return Labo
     */
    public function setLabo($labo)
    {
        $this->labo = $labo;

        return $this;
    }

    /**
     * Get labo
     *
     * @return string 
     */
    public function getLabo()
    {
        return $this->labo;
    }
}
