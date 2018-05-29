<?php 
include('Database.php');
define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
define("PDF_UPLOADS", DOC_ROOT."minicar/uploads/");
class Carmodel {
    private $modelName;
    private $color;
    private $year;
    private $manufactureId;
    private $registrationNumber;
    private $description;
    private $quantity;
    private $modelId;

    function __construct() {
        $this->modelName = isset($_POST['modelName']) ? $_POST['modelName'] : null;
        $this->color = isset($_POST['color']) ? $_POST['color'] : null;
        $this->year = isset($_POST['year']) ? $_POST['year'] : null;
        $this->manufacturerId = isset($_POST['manufacturer']) ? $_POST['manufacturer'] : null;
        $this->registrationNumber = isset($_POST['regnum']) ? $_POST['regnum'] : null;
        $this->description = isset($_POST['description']) ? $_POST['description'] : null;
        $this->quantity = isset($_POST['qty']) ? $_POST['qty'] : null;
        $this->modelId = isset($_POST['modelId']) ? $_POST['modelId'] : null;
        $this->files = isset($_FILES) ? $_FILES : null;
    }

    function AddModel() {
        $currentdate = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
        $files = array();
        $pic1 = '';
        $pic2 = '';
        if(!empty($this->files))
        {
            $files = $this->files;
            $i = 1;
            foreach ($files as $key => $value) {
                $name = $value['name'];
                $size = $value['size'];
                $type = $value['type'];
                $tmp_name = $value['tmp_name'];
                $pic = 'pic'.$i;
                $$pic = $name;

                if (isset($name)) 
                {
                    if (!empty($name)) 
                    {
                        move_uploaded_file($tmp_name, PDF_UPLOADS. $name);
                    }
                }
                $i++;
            }    
        }
        
        if (empty($this->modelName) || empty($this->color) || empty($this->year) || empty($this->manufacturerId) || empty($this->registrationNumber) || empty($this->description)) {
            throw new Exception("Empty Post not allowed");
        }
		else
        {
             $modelName = $this->modelName;
             $color = $this->color;
             $year = $this->year;
             $manufactureId = $this->manufacturerId;
             $registrationNumber =  $this->registrationNumber;
             $description = $this->description;
             $quantity = $this->quantity;

             $database = new Database();
             $db = $database->getDB();
             $sql = "INSERT INTO car_model (manufacturer_id, model_name, color, manufacture_year, registration_no, desccription, picture1, picture2, quantity, addeddate) VALUES (?,?,?,?,?,?,?,?,?,?)";
             $stmt= $db->prepare($sql);
             $stmt->execute([$manufactureId, $modelName, $color, $year, $registrationNumber, $description,$pic1,$pic2, $quantity, $currentdate]);
             $response = array("status"=>"success","Message"=>"Model Uploaded succssfully");
             echo json_encode($response);
             exit;
        }
    }

    function getAllModels()
    {
        $database = new Database();
        $db = $database->getDB();

        $stmt = $db->query("SELECT cm.*,m.name FROM car_model as cm INNER JOIN manufacturer as m where m.id = cm.manufacturer_id");
        $models = $stmt->fetchAll();
        return $models;

    }

    function deleteModel()
    {
        $database = new Database();
        $db = $database->getDB();
        $modelId = $this->modelId;

        $sql = "DELETE FROM car_model WHERE id = ?";
        $stmt= $db->prepare($sql);
        $stmt->execute([$modelId]);


        $response = array("status"=>"success","Message"=>"Model Deleted succssfully");
        echo json_encode($response);
        exit;
    }
}

$carmodel = new Carmodel();
if(isset($_POST['addmodel']))
{
    $carmodel->AddModel();
}

if(isset($_POST['modelId']))
{
    $carmodel->deleteModel();
}





?>