<?php

namespace M2mobi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="username", message="Username already exists")
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\MinLength(5)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $username;

    /**
     * @ORM\Column(type="date")
     */
    protected $birthDate;

    function __construct() {
        print $this->salt;
    } 

    function getFirstname() {
        return $this->firstname;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getUsername() {
        return $this->username;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTime $birthDate = null)
    {
        $this->birthDate = $birthDate;
    }

    public function getSalt() {
        if(empty($this->salt)) {
            return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        } else {
            return $this->salt;
        }
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

}
