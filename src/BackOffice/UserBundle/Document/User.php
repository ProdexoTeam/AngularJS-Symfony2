<?php

namespace BackOffice\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * BackOffice\UserBundle\Document\User
 *
 * @MongoDB\Document
 * @MongoDB\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class User extends BaseUser {

    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\ReferenceMany(targetDocument="MyProject\MyBundle\Document\Group")
     */
    protected $groups;

    public function __construct() {
        parent::__construct();
        // your own logic
    }

}
