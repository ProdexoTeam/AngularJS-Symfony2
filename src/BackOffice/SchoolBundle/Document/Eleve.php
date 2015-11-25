<?php

namespace BackOffice\SchoolBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * BackOffice\SchoolBundle\Document\Eleve
 *
 * @ODM\Document(
 *     repositoryClass="BackOffice\SchoolBundle\Document\EleveRepository"
 * )
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class Eleve
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
    
      /**
     *  @var
     *  @ODM\ReferenceOne(targetDocument="Classe")
     *  
     */
    private $classe;



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

    /**
     * Set classe
     *
     * @param BackOffice\SchoolBundle\Document\Classe $classe
     * @return self
     */
    public function setClasse(\BackOffice\SchoolBundle\Document\Classe $classe)
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * Get classe
     *
     * @return BackOffice\SchoolBundle\Document\Classe $classe
     */
    public function getClasse()
    {
        return $this->classe;
    }
    public function __toString() {
        return $this->getName();
    }
}
