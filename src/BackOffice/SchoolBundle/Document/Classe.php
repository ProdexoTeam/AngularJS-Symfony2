<?php

namespace BackOffice\SchoolBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * BackOffice\SchoolBundle\Document\Classe
 *
 * @ODM\Document(
 *     repositoryClass="BackOffice\SchoolBundle\Document\ClasseRepository"
 * )
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Classe
{
    /**
     * @var MongoId $id
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ODM\Field(name="name", type="string")
     */
    protected $name;
    
    /** @ODM\ReferenceMany(targetDocument="Eleve", cascade={"persist"})
     *  @var Eleve[]
     */
    private $eleve;


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->eleve = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add eleve
     *
     * @param BackOffice\SchoolBundle\Document\Eleve $eleve
     */
    public function addEleve(\BackOffice\SchoolBundle\Document\Eleve $eleve)
    {
        $this->eleve[] = $eleve;
    }

    /**
     * Remove eleve
     *
     * @param BackOffice\SchoolBundle\Document\Eleve $eleve
     */
    public function removeEleve(\BackOffice\SchoolBundle\Document\Eleve $eleve)
    {
        $this->eleve->removeElement($eleve);
    }

    /**
     * Get eleve
     *
     * @return \Doctrine\Common\Collections\Collection $eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }
}
