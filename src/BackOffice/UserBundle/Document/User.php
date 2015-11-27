<?php

namespace BackOffice\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * BackOffice\UserBundle\Document\User
 *
 * @ODM\Document
 * @ODM\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class User extends BaseUser {

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="BackOffice\UserBundle\Document\Group")
     */
    protected $groups;

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set groups
     *
     * @param BackOffice\UserBundle\Document\Group $groups
     * @return self
     */
    public function setGroups(\BackOffice\UserBundle\Document\Group $groups)
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * Get groups
     *
     * @return BackOffice\UserBundle\Document\Group $groups
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
