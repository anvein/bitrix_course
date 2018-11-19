<?php

namespace Anvein\Geotarget\Entities;


class Region
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

}