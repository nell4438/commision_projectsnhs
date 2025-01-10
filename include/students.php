<?php
require_once LIB_PATH . DS . 'database.php';
class Student
{

    protected static $tblname = "tblstudent";

    public function dbfields()
    {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);

    }
    public function listofstudent()
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname);
        return $cur;
    }
    public function find_student($id = "", $name = "")
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . "
			WHERE IDNO = {$id} OR LNAME = '{$name}'");
        $cur = $mydb->executeQuery();
        $row_count = $mydb->num_rows($cur);
        return $row_count;
    }

    public function find_all_student($lname = "", $fname = "", $mname = "")
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . "
			WHERE LNAME = '{$lname}' AND FNAME= '{$fname}' AND MNAME='{$mname}'");
        $cur = $mydb->executeQuery();
        $row_count = $mydb->num_rows($cur);
        return $row_count;
    }

    public function single_student($id = "")
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . "
				Where IDNO= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }
    public function studAuthentication($email, $h_pass)
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM `tblstudent` WHERE `IDNO`='" . $email . "' OR `email` = '" . $email . "' AND `password` = '" . $h_pass . "'");
        $cur = $mydb->executeQuery();
        if ($cur == false) {
            die(mysql_error());
        }
        $row_count = $mydb->num_rows($cur); //get the number of count
        if ($row_count == 1) {
            $student_found = $mydb->loadSingleResult();
            $_SESSION['IDNO'] = $student_found->IDNO;
            $_SESSION['email'] = $student_found->email;
            $_SESSION['password'] = $student_found->password;
            $_SESSION['FNAME'] = $student_found->FNAME;
            $_SESSION['LNAME'] = $student_found->LNAME;
            $_SESSION['MI'] = $student_found->MNAME;
            $_SESSION['PADDRESS'] = $student_found->HOME_ADD;
            $_SESSION['COURSEID'] = $student_found->COURSE_ID;
            $_SESSION['SEMESTER'] = $student_found->SEMESTER;
            $_SESSION['CONTACT'] = $student_found->CONTACT_NO;
            $_SESSION['SY'] = $student_found->SYEAR;
            $_SESSION['COURSELEVEL'] = $student_found->YEARLEVEL;
            return true;
        } else {
            return false;
        }
    }

    /*---Instantiation of Object dynamically---*/
    public static function instantiate($record)
    {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    /*--Cleaning the raw data before submitting to Database--*/
    private function has_attribute($attribute)
    {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes()
    {
        // return an array of attribute names and their values
        global $mydb;
        $attributes = array();
        foreach ($this->dbfields() as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes()
    {

        global $mydb;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $mydb->escape_value($value);
        }
        return $clean_attributes;
    }

    /*--Create,Update and Delete methods--*/
    public function save()
    {

        // A new record won't have an id yet.
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {

        global $mydb;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . self::$tblname . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        echo $mydb->setQuery($sql);

        if ($mydb->executeQuery()) {
            $this->id = $mydb->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update($id = 0)
    {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            if ($key != 'IDNO') {
                $attribute_pairs[] = "{$key}='{$value}'";
            }

        }
        $sql = "UPDATE " . self::$tblname . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE IDNO=" . $id;
        $mydb->setQuery($sql);
        // echo "Executing SQL: $sql";

        if (!$mydb->executeQuery()) {
            echo "Update failed: "; 
            return false;
        }
    }

    public function delete($id = 0)
    {
        global $mydb;
        $sql = "DELETE FROM " . self::$tblname;
        $sql .= " WHERE IDNO=" . $id;
        $sql .= " LIMIT 1 ";
        $mydb->setQuery($sql);

        if (!$mydb->executeQuery()) {
            return false;
        }

    }

    public function setFile($fileType, $path)
    {
        // session_start();
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "admin";
        $db_name = "projectsnhs";
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Failed to connect to MySQL: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM `tblstudfile` WHERE IDNO = ?");
        $stmt->bind_param('i', $_SESSION['IDNO']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $sql = "UPDATE tblstudfile SET $fileType = ? WHERE IDNO  = ?";
        } else {
            $sql = "INSERT INTO tblstudfile ($fileType, IDNO ) VALUES (?, ?)";
        }
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param('si', $path, $_SESSION['IDNO']);
        return $stmt2->execute();
    }

    public function single_studentfile($id = "")
    {
        global $mydb;
        $mydb->setQuery("SELECT * FROM tblstudfile Where IDNO= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }
}
