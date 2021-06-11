<?php
class subject {

    public $idSubject, $codeSubject, $nameSubject, $idYear, $idMajor;

    public function __construct($idSubject, $codeSubject, $nameSubject, $idYear, $idMajor) {
	$this->idSubject=$idSubject;
	$this->codeSubject=$codeSubject;
	$this->nameSubject=$nameSubject;
	$this->idYear=$idYear;
	$this->idMajor=$idMajor;
    }
	
}

class subjectlist {

    public $list;
	public $faculty;

	public function __construct(){
		$subjectv = new subject(0, '0', '0','0','0');
		$this->list[] = $subjectv;
	}
	public function check($faculty){
		if($this->faculty == $faculty)
			return true;
		else{
		$this->unsetall();
		$this->faculty = $faculty;			
		}
	}
	
   public function add($subjectt) {
	for ($i = 1; $i < count($this->list); $i++) {
        if ($this->list[$i]->idSubject == $subjectt->idSubject)
		{
        return false;}
	}
        $this->list[] = $subjectt;
		return true;
    }

    public function checkidsubject($idSubject) {
        for ($i = 1; $i < count($this->list); $i++) {
            if ($this->list[$i]->idSubject == $idSubject){
			return 1;}
        }
		return 0;
    }

    public function unsetall() {
	  $this->list = array();
	  		$subjectv = new subject(0, '0', '0','0','0');
		$this->list[] = $subjectv;
	  
    }
	public function unsetbyid($idSubject) {
		for ($i = 1; $i < count($this->list); $i++){
			if ($this->list[$i]->idSubject == $idSubject){
        unset($this->list[$i]);
		break;
			}
		}
		$this->list=array_values($this->list);//reindex 
	}	
}

?>