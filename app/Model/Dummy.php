<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 02/09/2018
 * Time: 11:46 PM
 */

namespace App\Model;


class Dummy
{


    private $names;
    private $email;
    private $company;
    private $city;
    private $country;
    private $coordinates;

    /**
     * Dummy constructor.
     */
    public function __construct() {
        $this->coordinates = "-88.18757, -78.7753";
        $this->email = "dummy@mail.com";
    }

    /**
     * @return mixed
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param mixed $names
     */
    public function setNames($names)
    {
        $this->names = $names;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }



}