<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 18.06.2018
 * Time: 17:00
 */

namespace IoT\Repository;


use IoT\Entity\EntryCollection;
use Psr\Container\ContainerInterface;

class EntryRepository
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var \PDO
     */
    private $db;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $this->container['db'];
    }

    public function getAllEntries() {
        $sql = $this->db->prepare("SELECT c.camera_name, e.entry_time FROM entry e JOIN camera c ON c.camera_id=e.fk_camera_id");
        $sql->execute();
        return new EntryCollection(['entries' => $sql->fetchAll()]);
    }

    public function insertEntry($fk_camera_id, $entry_time) {
        $sql = $this->db->prepare("INSERT INTO entry(fk_camera_id, entry_time) VALUES ($fk_camera_id, '$entry_time')");
        return $sql->execute();
    }
}