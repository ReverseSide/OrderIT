<?php

namespace OrderIT\Bundle\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="fk_comment_list1_idx", columns={"listing_id_listing"})})
 * @ORM\Entity
 */
class Comment
{
    public function __toString() {
        return $this->getComment();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id_comment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idComment;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="crea_comment", type="datetime", nullable=true)
     */
    private $creaComment;

    /**
     * @var \Listing
     *
     * @ORM\ManyToOne(targetEntity="Listing")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="listing_id_listing", referencedColumnName="id_listing")
     * })
     */
    private $listingListing;



    /**
     * Get idComment
     *
     * @return integer 
     */
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Comment
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set creaComment
     *
     * @param \DateTime $creaComment
     * @return Comment
     */
    public function setCreaComment($creaComment)
    {
        $this->creaComment = $creaComment;

        return $this;
    }

    /**
     * Get creaComment
     *
     * @return \DateTime 
     */
    public function getCreaComment()
    {
        return $this->creaComment;
    }

    /**
     * Set listingListing
     *
     * @param \OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing
     * @return Comment
     */
    public function setListingListing(\OrderIT\Bundle\OrderBundle\Entity\Listing $listingListing = null)
    {
        $this->listingListing = $listingListing;

        return $this;
    }

    /**
     * Get listingListing
     *
     * @return \OrderIT\Bundle\OrderBundle\Entity\Listing 
     */
    public function getListingListing()
    {
        return $this->listingListing;
    }
}
