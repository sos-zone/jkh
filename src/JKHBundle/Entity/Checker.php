<?php

namespace JKHBundle\Entity;

/**
 * Checker
 */
class Checker
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $checkmailcode;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Checker
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set checkmailcode
     *
     * @param string $checkmailcode
     *
     * @return Checker
     */
    public function setCheckmailcode($checkmailcode)
    {
        $this->checkmailcode = $checkmailcode;

        return $this;
    }

    /**
     * Get checkmailcode
     *
     * @return string
     */
    public function getCheckmailcode()
    {
        return $this->checkmailcode;
    }
}
