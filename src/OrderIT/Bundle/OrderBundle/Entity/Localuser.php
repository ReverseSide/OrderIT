<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use FR3D\LdapBundle\Model\LdapUserInterface as LdapUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="localuser")
 */
class Localuser extends BaseUser implements LdapUserInterface
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $dn;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $language;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->roles)) {
            $this->roles[] = 'ROLE_USER';
        }
    }
    public function setDn($dn) {
        $this->dn = $dn;
    }
    public function getDn() {
        return $this->dn;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setLanguage($language) {
        $this->language = $language;
    }
}