<?php

namespace Anvein\Geotarget\Entities;


class Country
{

    protected $code = null;
    protected $curCode = null;

    protected $name = null;
    protected $lang = null;

    protected $lat = null;
    protected $lon = null;
    protected $phoneCode = null;


    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = strtolower($code);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurCode()
    {
        return $this->curCode;
    }

    /**
     * @param string|null $curCode
     * @return $this
     */
    public function setCurCode(string $curCode)
    {
        $this->curCode = strtolower($curCode);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return $this
     */
    public function setLat(float $lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param float|null $lon
     * @return $this
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneCode()
    {
        return $this->phoneCode;
    }

    /**
     * @param string|null $phoneCode
     * @return $this
     */
    public function setPhoneCode(string $phoneCode)
    {
        $this->phoneCode = $phoneCode;
        return $this;
    }




}