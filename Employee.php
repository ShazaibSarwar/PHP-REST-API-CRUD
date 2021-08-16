<?php 

class Employee{
    private $db;
    private $db_table = "employee";

    // Database tables are 
    public $id;
    public $name;
    public $email;
    public $designation;
    public $created;
    public $result;


    // Making Database Connection 
    public function __construct($db)
    {
        $this->db = $db;
    }
    

    // Getting All Employees Thriugh Database
    public function getEmployees()
    {
        $query = "SELECT id, name, email, designation, created FROM " . $this->db_table . "";
        $this->result = $this->db->query($query);
        
        return $this->result; 
    }
    

    // Inserting Data into Database
    public function createEmployee()
    {
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->email       = htmlspecialchars(strip_tags($this->email));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created     = htmlspecialchars(strip_tags($this->created));

        $EmailQuery = "SELECT * FROM ". $this->db_table ." WHERE email = '".$this->email."'";
       
        $this->db->query($EmailQuery);
        
        if($this->db->affected_rows > 0)
        {
            $respose["status"] = 409;
            $respose["Message"] = "Email Already Exist";
            echo json_encode($respose);
            die();

        }else
        {

            $query = "INSERT INTO ". $this->db_table ." SET name = '".$this->name."', email = '".$this->email."', designation = '".$this->designation."',created = '".$this->created."'";

            $this->db->query($query);

            if($this->db->affected_rows > 0)
            {
                return true;
            }
            else{
                return false;
            }

        } 
    }


    // Getting Single Record From DB
    public function getSingleEmployee()
    {
        $query = "SELECT id, name, email, designation, created FROM ". $this->db_table ." WHERE id = ".$this->id;

        $record = $this->db->query($query);

        $dataRow = $record->fetch_assoc();

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];

    }




    // Updating Employees in Database
    public function updateEmployee(){

        $this->name        =  htmlspecialchars(strip_tags($this->name));
        $this->email       =  htmlspecialchars(strip_tags($this->email));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created     = htmlspecialchars(strip_tags($this->created));
        $this->id          = htmlspecialchars(strip_tags($this->id));

        $sqlQuery = "UPDATE ". $this->db_table ." SET name = '".$this->name."', email = '".$this->email."', designation = '".$this->designation."',created = '".$this->created."'WHERE id = ".$this->id;

        $this->db->query($sqlQuery);

        if($this->db->affected_rows > 0)
        {
            return true;
        }
        else{
            return false;
        }

    }


    // Deleteing Emloyee Record
    public function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id;
        $this->db->query($sqlQuery);

        if($this->db->affected_rows > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }


}

?>