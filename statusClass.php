<?php 

class Status{
    protected $id;
    protected $active;
    protected $title;
    
    function __construct($id =null,$active =null,$title=null ) {
        $this->id = (int) $id;
        $this->active = $active;
        $this->title = $title;
    }
    
    public function getList(){
        $list = [];
        $sql = "SELECT * FROM status WHERE active = 1";
        $result = conn::R()->query($sql);
        while($row = $result->fetch(PDO::FETCH_OBJ) ){
            $list[] = $row;
        }
        return $list;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title =  $title;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active =  $active;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) $id;
    }
}
?>