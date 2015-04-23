<?php
namespace OrderIT\Bundle\OrderBundle\Entity;
use Doctrine\ORM\EntityRepository;

class DemandRepository extends EntityRepository
{
public function findAll()
{
return $this->findBy(array(), array('creaDemand' => 'DESC'));

}
}