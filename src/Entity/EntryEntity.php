<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 18.06.2018
 * Time: 15:31
 */

namespace IoT\Entity;


class EntryEntity extends ArrayObject
{
    public $camera_name;

    public $entry_time;

    /**
     * Coin constructor.
     * @param null|array $entry
     */
    public function __construct($entry = null)
    {
        $this->exchangeArray($entry);
    }
}