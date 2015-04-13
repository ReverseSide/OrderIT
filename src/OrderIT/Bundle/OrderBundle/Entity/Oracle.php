<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oracle
 *
 * @ORM\Table(name="oracle", uniqueConstraints={@ORM\UniqueConstraint(name="oracle_UNIQUE", columns={"oracle"})})
 * @ORM\Entity
 */
class Oracle
{
    public function __toString() {
        return $this->getOracle();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_oracle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOracle;

    /**
     * @var string
     *
     * @ORM\Column(name="oracle", type="string", length=6, nullable=false)
     */
    private $oracle;



    /**
     * Get idOracle
     *
     * @return integer 
     */
    public function getIdOracle()
    {
        return $this->idOracle;
    }

    /**
     * Set oracle
     *
     * @param string $oracle
     * @return Oracle
     */
    public function setOracle($oracle)
    {
        $this->oracle = $oracle;

        return $this;
    }

    /**
     * Get oracle
     *
     * @return string 
     */
    public function getOracle()
    {
        return $this->oracle;
    }
}
