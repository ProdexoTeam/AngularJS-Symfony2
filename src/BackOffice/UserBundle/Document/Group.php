<?php

namespace BackOffice\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Group extends BaseGroup {

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\ReferenceMany(targetDocument="BackOffice\UserBundle\Document\User")
     */
    private $user = array();

    public function __construct($name, $roles = array()) {
        parent::__construct($name, $roles);
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
     * Add user
     *
     * @param BackOffice\UserBundle\Document\User $user
     */
    public function addUser(\BackOffice\UserBundle\Document\User $user) {
        $this->user[] = $user;
    }

    /**
     * Remove user
     *
     * @param BackOffice\UserBundle\Document\User $user
     */
    public function removeUser(\BackOffice\UserBundle\Document\User $user) {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection $user
     */
    public function getUser() {
        return $this->user;
    }

    public function __toString() {
        return $this->getName();
    }

}
