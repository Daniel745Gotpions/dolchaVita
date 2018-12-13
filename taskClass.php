<?php 

class Task{
    protected $id;
    protected $dateAdd;
    protected $name;
    protected $statusId;
    
    function __construct($id =null,$dateAdd =null,$name=null, $statusId = null) {
        $this->id = (int)$id;
        $this->dateAdd = $dateAdd;
        $this->name = $name;
        $this->statusId =(int) $statusId;
    }

    public function insert(){

        $stmt = conn::R()->prepare("INSERT INTO task (dateAdd,name,statusId) VALUES(?,?,?)");
        $stmt->execute(array($this->dateAdd,$this->name,$this->statusId));
        return conn::R()->lastInsertId();
    }

    public function edit(){
        
        $stmt = conn::R()->prepare("UPDATE task SET dateAdd=?,name=?, statusId=?
        WHERE id = ".$this->id);
        $stmt->execute(array($this->dateAdd, $this->name,$this->statusId));
        return $stmt->rowCount();
    }

    public function deleteTask(){
        $sql = " DELETE FROM task WHERE id = ".$this->id;
        $result = conn::R()->query($sql);
        $json = $this->getResult();
        $json['taskId'] = $this->id;
        if( $result->rowCount() ){
            $json['status'] = true;
            $json['message'] = "";
        }else{
            $json['message'] = "couldn't Find Task";
            $json['status'] = false;
        }
        return $json;
    }


    public function getResult( $spesificId = false ){
        $json = ["length"=>0,"completed"=>0,"remaining"=>0];
        $sql = "SELECT task.id,task.dateAdd,task.name,status.title,statusId  
        FROM task
        INNER JOIN status on status.id = task.statusId";
        if($spesificId){
            $sql.=" WHERE task.id = ".$this->id;
        }

        $result = conn::R()->query($sql);

        $json['length'] = $result->rowCount() ;
        // output data of each row
        while($row = $result->fetch(PDO::FETCH_OBJ) ) {
            $json['data'][] =  $row; 
            $json[$row->title]++;
        }
        return $json;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStatusId() {
        return $this->statusId;
    }

    public function setStatusId($statusId) {
        $this->statusId = (int) $statusId;
    }

    public function getDateAdd() {
        return $this->dateAdd;
    }

    public function setDateAdd($dateAdd) {
        $this->dateAdd = $dateAdd;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }
}
?>