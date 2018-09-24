<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 02/09/2018
 * Time: 11:46 PM
 */

namespace App\Model;


class People
{
    private $name;
    private $date;
    private $age;
    private $email;
    private $address;

    /**
     * People constructor.
     *
     * @param $name
     * @param $date
     * @param $age
     * @param $email
     * @param $address
     */
    public function __construct($name, $date, $age, $email, $address)
    {
        $this->name = $name;
        $this->date = $date;
        $this->age = $age;
        $this->email = $email;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }




}