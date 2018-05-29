<?php 
include('Database.php');




class Manufacturer {
    private $manufacturerName;

    function __construct() {
        $this->manufacturerName = isset($_POST['manufacturerName']) ? $_POST['manufacturerName'] : null;
    }

    function AddManufacturer() {
    	$currentdate = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
        if (empty($this->manufacturerName)) {
            throw new Exception("Empty Post not allowed");
        }
		else
        {
        	$manufacturerName = $this->manufacturerName;
        	$database = new Database();
        	$db = $database->getDB();
	        $sql = "INSERT INTO manufacturer (name, addeddate) VALUES (?,?)";
	        $stmt= $db->prepare($sql);
	        $stmt->execute([$manufacturerName, $currentdate]);
        }
    }

    function getAllManufacturer()
    {
    	$database = new Database();
        $db = $database->getDB();

        $stmt = $db->query("SELECT * FROM manufacturer ORDER BY id DESC");
        $manufacturers = $stmt->fetchAll();

        return $manufacturers;

    }
}

$manufacturer = new Manufacturer();
if(!empty($_POST) && $_POST['action'] == 'AddManufacturer')
{
    $manufacturer->AddManufacturer();
}





?>