<?php

class permission
{
	public $username;
	public $password;

	function __construct($u, $p) {
		$this->username = $u;
		$this->password = $p;
	}

	function __toString() {
		return $u.$p;
	}

	function is_teacher() {
		$teacher = false;
        
        $con1 = new mysqli("localhost","kali","kali","class");
		if ($con1->connect_error) {
			die("Connection failed: " . $con1->connect_error);
		}
		$user = $this->username;
		$pass = $this->password;
		$stmt = $con1->prepare("SELECT * FROM teacher WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        if($stmt->fetch() == 1){
            $teacher = true;
        }
        return $teacher;
	}

    function is_student() {
        $student = false;

        $con2 = new mysqli("localhost","kali","kali","class");
		if ($con2->connect_error) {
			die("Connection failed: " . $con2->connect_error);
		}
		$user = $this->username;
		$pass = $this->password;
		$stmt = $con2->prepare("SELECT * FROM student WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        if($stmt->fetch() == 1){
            $student = true;
        }
        return $student;
    }
}

?>