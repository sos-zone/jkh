<?php

namespace JKHBundle\Entity;

/**
 * User2
 */
class User2
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $indentnum;

    /**
     * @var int
     */
    private $litzschet;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var string
     */
    private $fio;


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
     * Set indentnum
     *
     * @param string $indentnum
     *
     * @return User2
     */
    public function setIndentnum($indentnum)
    {
        $this->indentnum = $indentnum;

        return $this;
    }

    /**
     * Get indentnum
     *
     * @return string
     */
    public function getIndentnum()
    {
        return $this->indentnum;
    }

    /**
     * Set litzschet
     *
     * @param integer $litzschet
     *
     * @return User2
     */
    public function setLitzschet($litzschet)
    {
        $this->litzschet = $litzschet;

        return $this;
    }

    /**
     * Get litzschet
     *
     * @return int
     */
    public function getLitzschet()
    {
        return $this->litzschet;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User2
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
     * Set pass
     *
     * @param string $pass
     *
     * @return User2
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set fio
     *
     * @param string $fio
     *
     * @return User2
     */
    public function setFio($fio)
    {
        $this->fio = $fio;

        return $this;
    }

    /**
     * Get fio
     *
     * @return string
     */
    public function getFio()
    {
        return $this->fio;
    }
}
