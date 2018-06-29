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

    private $entries;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
//        $this->db = $this->container['db'];
    }

    public function getAllEntries() {
	$row = 1;
	$entries = [];

if (($handle = fopen("entries.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;

	array_push($entries, ['camera_name'=>$data[1],'entry_time'=>$data[2]]);
  }
  fclose($handle);
}

        print_r($data);
        return new EntryCollection(['entries' => $entries]);
    }

    public function insertEntry($camera_name, $entry_time) {
        $handle = fopen("entries.csv", "a");
        fputcsv($handle, ",".$camera_name.",".$entry_time);
        fclose($handle);
//        $sql = $this->db->prepare("INSERT INTO entry(fk_camera_id, entry_time) VALUES ($fk_camera_id, '$entry_time')");
        return true;
    }
}
