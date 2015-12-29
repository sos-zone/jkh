<?php

namespace JKHBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $indentNum;

    /**
     * @var int
     */
    private $litzSchet;

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
     * Set indentNum
     *
     * @param string $indentNum
     *
     * @return User
     */
    public function setIndentNum($indentNum)
    {
        $this->indentNum = $indentNum;

        return $this;
    }

    /**
     * Get indentNum
     *
     * @return string
     */
    public function getIndentNum()
    {
        return $this->indentNum;
    }

    /**
     * Set litzSchet
     *
     * @param integer $litzSchet
     *
     * @return User
     */
    public function setLitzSchet($litzSchet)
    {
        $this->litzSchet = $litzSchet;

        return $this;
    }

    /**
     * Get litzSchet
     *
     * @return int
     */
    public function getLitzSchet()
    {
        return $this->litzSchet;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * @return User
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
     * @return User
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
