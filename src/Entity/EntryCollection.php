<?php

namespace IoT\Entity;

use IoT\Entity\EntryEntity;

/**
 * Created by PhpStorm.
 * User: doke
 * Date: 18.06.2018
 * Time: 15:30
 */

class EntryCollection extends ArrayObject
{
    public $entries;

    public function __construct($params)
    {
        if (!is_array($params)) {
            throw new \Exception('Array expectet, ' .
                gettype($params) .
                ' passed.');
        }
        $this->exchangeArray($params);
        $this->exchangeObjects();
    }

    /**
     * Create Coin objects out of the Record Set
     * and fills up the class property coins with these
     */
    public function exchangeObjects()
    {
        $coinsObject = [];
        foreach ($this->entries as $coin) {
            $coinsObject[] = new EntryEntity($coin);
        }
        $this->entries = $coinsObject;
    }

}