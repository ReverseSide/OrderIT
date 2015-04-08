<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localuser
 *
 * @ORM\Table(name="localuser")
 * @ORM\Entity
 */
class Localuser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_id_group", type="integer", nullable=true)
     */
    private $groupIdGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="vorname", type="string", length=45, nullable=true)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=true)
     */
    private $mail;



    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set groupIdGroup
     *
     * @param integer $groupIdGroup
     * @return Localuser
     */
    public function setGroupIdGroup($groupIdGroup)
    {
        $this->groupIdGroup = $groupIdGroup;

        return $this;
    }

    /**
     * Get groupIdGroup
     *
     * @return integer 
     */
    public function getGroupIdGroup()
    {
        return $this->groupIdGroup;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Localuser
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set vorname
     *
     * @param string $vorname
     * @return Localuser
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string 
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Localuser
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }
}
