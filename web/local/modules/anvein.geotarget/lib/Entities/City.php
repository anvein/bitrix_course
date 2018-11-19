<?php

namespace Anvein\Geotarget\Entities;


class City
{
    protected $name = null;

    protected $lat = null;
    protected $lon = null;

    protected $lang = null;


    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
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
     * @param float $lon
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

}