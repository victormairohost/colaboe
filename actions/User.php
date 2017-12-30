<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author harry
 */
class User {

    //put your code here
    public $db_hostname = 'localhost', $db_database = 'colaboe', $db_username = 'buezeh', $db_pass = 'P@yr00ll', $conn = 0;
    public $email = "", $fname = "", $lname = "", $phone = "", $pass = "", $gender = "", $uid = 0, $iscomplete = false;
    public $bname = "", $acctype = "", $accname = "", $accno = "", $regdate = 0, $admin = 0, $isvered = 1;
    public $block = 0, $refs = 0, $cycles = 0;

    function User($Email) {
        $this->conn = new mysqli($this->db_hostname, $this->db_username, $this->db_pass, $this->db_database);
        $this->email = $Email;
        $this->getPD();
    }

    function getPD() {
        $query = 'SELECT * FROM persons where email="' . $this->email . '"';
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed " . mysqli_error($this->conn));
        }
        $rows = mysqli_fetch_assoc($result);
        $this->uid = $rows['uid'];
        $this->phone = $rows['phone'];
        $this->lname = $rows['lname'];
        $this->fname = $rows['fname'];
        $this->pass = $rows['pass'];
        $this->gender = $rows['gender'];
        $this->regdate = $rows['regdate'];
        $this->getAD();
    }

    function getAD() {
        $query = 'SELECT * FROM accounts where uid=' . $this->uid;
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            $this->iscomplete = false;
            return false;
        }
        $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($rows) > 0) {
            $this->bname = $rows[0]['bname'];
            $this->accno = $rows[0]['accno'];
            $this->accname = $rows[0]['accname'];
            $this->acctype = $rows[0]['acctype'];
            $this->cycles = $rows[0]['cycles'];
            $this->refs = $rows[0]['refs'];
            $this->block = $rows[0]['block'];
            if ($this->bname == '') {
                $this->iscomplete = false;
            } elseif ($this->accno == '') {
                $this->iscomplete = false;
            } elseif ($this->accname == '') {
                $this->iscomplete = false;
            } elseif ($this->acctype == '') {
                $this->iscomplete = false;
            } else {
                $this->iscomplete = true;
            }
            if($rows[0]['admin'] == 10){
                $this->admin = 0;
                $this->isvered = 0;
            }else{
                $this->admin = $rows[0]['admin'];
            }
        }
    }

    function updateFname($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE persons SET fname='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->fname = $newshit;
        }
    }

    function updateLname($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE persons SET lname='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->lname = $newshit;
        }
    }

    function updateEmail($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE persons SET email='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->email = $newshit;
        }
    }

    function updatePhone($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE persons SET phone='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->phone = $newshit;
        }
    }

    function updateAccname($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE accounts SET accname='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->accname = $newshit;
        }
    }

    function updateAccno($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE accounts SET accno='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->accno = $newshit;
        }
    }

    function updateAcctype($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE accounts SET acctype='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->acctype = $newshit;
        }
    }

    function updateBname($shit) {
        $newshit = User::mysql_fix($shit);
        $query = "UPDATE accounts SET bname='$newshit' where uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($this->conn));
        } else {
            $this->bname = $newshit;
        }
    }

    function isAdmin() {
        $u = new User('foo@bar.com ');
        $conn = new mysqli($u->db_hostname, $u->db_username, '', $u->db_database);
        $query = 'SELECT * FROM accounts where uid=' . $this->uid;
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['admin'] > 0;
    }

    static function getEmail($uid) {
        $u = new User('foo@bar.com ');
        $query = 'SELECT * FROM persons where uid=' . $uid;
        $result = mysqli_query($u->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($u->conn));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['email'];
    }

    static function getID($email) {
        $u = new User('foo@bar.com ');
        $query = "SELECT * FROM persons where email='$email'";
        $result = mysqli_query($u->conn, $query);
        if (!$result) {
            die("Database access failed" . mysqli_error($u->conn));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['uid'];
    }

    static function getNameI($uid) {
        $u = new User('foo@bar.com ');
        $query = "SELECT * FROM persons where uid=$uid";
        $result = mysqli_query($u->conn, $query);
        if (!$result) {
            die("Database access failed " . mysqli_error($u->conn));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['fname'] . ' ' . $row['lname'];
    }

    static function getPhoneI($uid) {
        $u = new User('foo@bar.com ');
        $query = "SELECT * FROM persons where uid=$uid";
        $result = mysqli_query($u->conn, $query);
        if (!$result) {
            die("Database access failed " . mysqli_error($u->conn));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['phone'];
    }

    static function getNameE($email) {
        $u = new User('foo@bar.com ');
        $query = "SELECT * FROM persons where email='$email'";
        $result = mysqli_query($u->conn, $query);
        if (!$result) {
            die("Database access failed " . mysqli_error($u->conn));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['fname'] . ' ' . $row['lname'];
    }
    
    static function getVinfo($gorb){
    	$u = new User(User::getEmail(str_replace('304','', ''.$gorb)));
        $query = "SELECT * FROM email where uid=".(str_replace('304','', ''.$gorb));
        $result = mysqli_query($u->conn, $query);
        if (!$result)
            return 0;
        $row = mysqli_fetch_assoc($result);
        return count($row)>0?$row:0;
    }

    static function exists($email) {
        $u = new User('foo@bar.com ');
        $emai = User::mysql_fix($email);
        $query = 'SELECT * FROM persons where email="' . $emai . '"';
        $result = mysqli_query($u->conn, $query);
        $row = mysqli_fetch_object($result);
        return ($row != null);
    }

    static function existsPhone($phone) {
        $u = new User('foo@bar.com ');
        $emai = User::mysql_fix($phone);
        $query = 'SELECT * FROM persons where phone="' . $emai . '"';
        $result = mysqli_query($u->conn, $query);
        $row = mysqli_fetch_object($result);
        return ($row != null);
    }

    static function existsAccount($accno) {
        $u = new User('foo@bar.com ');
        $emai = User::mysql_fix($accno);
        $query = 'SELECT uid FROM accounts where accno="' . $emai . '"';
        $result = mysqli_query($u->conn, $query);
        $row = mysqli_fetch_object($result);
        return ($row != null);
    }

    static function mysql_fix($string) {
        $u = new User('foo@bar.com ');
        $string = trim($string);
        if (get_magic_quotes_gpc()) {
            $string = stripcslashes($string);
        }
        return mysqli_real_escape_string($u->conn, $string);
    }

    static function valid($email, $pass) {
        $u = new User('foo@bar.com ');
        $emai = User::mysql_fix($email);
        $query = 'SELECT * FROM persons where email="' . $emai . '"';
        $result = mysqli_query($u->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return ($row['pass'] != null) ? (md5($pass) == $row['pass']) : false;
    }

    static function make($email, $fname, $lname, $phone, $gender, $pass) {
        $u = new User('foo@bar.com ');
        $emai = User::mysql_fix($email);
        $fnam = User::mysql_fix($fname);
        $lnam = User::mysql_fix($lname);
        $phon = User::mysql_fix($phone);
        $gende = User::mysql_fix($gender);
        $query = "INSERT INTO persons VALUES (NULL, '$fnam', '$lnam', '$emai', MD5('$pass'), '$phon', '$gende' ,CURRENT_TIMESTAMP) ";
        mysqli_query($u->conn, $query);
        $uid = User::getID($emai);
        $query0 = "INSERT INTO accounts VALUES ($uid, '', '', '', '', 0, 0, 0, 10)";
        mysqli_query($u->conn, $query0);
        $shak = md5(time());
        $query0 = "INSERT INTO email VALUES ($uid, '$shak')";
        $result = mysqli_query($u->conn, $query0);
        return !$result ? null : new User($email);
    }
    
    function verify(){
        $query = "DELETE FROM email WHERE uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        $query = "UPDATE accounts set admin=0 WHERE uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
    }

    function getVer() {
        $query = "SELECT * FROM email WHERE uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return 1;
        $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($rows) < 1)
            return 1;
        return $rows[0];
    }

    function addC() {
        $query = "SELECT * FROM accounts WHERE uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_all($result, MYSQLI_BOTH);
            if (count($row) > 0) {
                $query = "UPDATE accounts SET cycles=cycles+1 WHERE uid=$this->uid";
                mysqli_query($this->conn, $query);
            }
        }
        return 0;
    }

    function getTime($plan) {
        $query = "SELECT * FROM prohelp WHERE uid=$this->uid && plan=$plan";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return 0;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        return (count($row) > 0) ? $row[0]['time'] : 0;
    }

    function getStatus($plan) {
        return $this->istobepayed($plan) ? 'taking' : $this->getPayee($plan) ? 'giving' : '';
    }

    function getPayers($plan) {
        $query = "SELECT * FROM prohelp WHERE uid2=$this->uid && plan=$plan";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return 0;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        return (count($row) > 0) ? $row : array();
    }
    
    function getPayer($plan, $uid) {
        $query = "SELECT * FROM prohelp WHERE uid=$uid && plan=$plan";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return 0;
        $row = mysqli_fetch_assoc($result);
        return (count($row) > 0) ? $row : array();
    }

    function getPayee($plan) {
        $query = "SELECT * FROM prohelp WHERE uid=$this->uid && plan=$plan";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return 0;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        return (count($row) > 0) ? new User(User::getEmail($row[0]['uid2'])) : 0;
    }

    function getHelp($plan) {
        $query = "SELECT * FROM gethelp WHERE plan=$plan && time='0000-00-00 00:00:00'";
        $result = mysqli_query($this->conn, $query);
        if (!$result || count(mysqli_fetch_all($result, MYSQLI_BOTH)) == 0) {
            $query = "INSERT INTO gethelp VALUES (" . $this->uid . ", $plan, 1, '0000-00-00 00:00:00')";
            mysqli_query($this->conn, $query);
            return 1;
        }return 0;
    }

    function proHelp($plan) {
        if ($this->admin > 0) {
            $this->getHelp($plan);
            return;
        }
        if ($this->getPayee($plan) instanceof User)
            return;
        if ($this->istobepayed($plan) == true)
            return; {
            $query = "SELECT * FROM gethelp WHERE times<2 && plan=$plan ORDER BY time ASC";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                $row = mysqli_fetch_all($result, MYSQLI_BOTH);
                if (count($row) > 0) {
                    if ($this->uid == $row[0]['uid'])
                        return;
                    $query = "INSERT INTO prohelp VALUES ($this->uid, $plan, " . $row[0]['uid'] . ", '', CURRENT_TIMESTAMP)";
                    mysqli_query($this->conn, $query);
                    $query = "UPDATE gethelp SET times=times+1 WHERE plan=$plan && uid=" . $row[0]['uid'];
                    mysqli_query($this->conn, $query);
                    return;
                }
            }
            $query = "SELECT * FROM gethelp WHERE plan=$plan && time='0000-00-00 00:00:00'";
            $result = mysqli_query($this->conn, $query);
            if (!$result || count(mysqli_fetch_all($result, MYSQLI_BOTH)) == 0) {
                $query = "INSERT INTO prohelp VALUES ($this->uid, $plan, 1000, '', CURRENT_TIMESTAMP)";
                mysqli_query($this->conn, $query);
                $query = "INSERT INTO gethelp VALUES (1000, $plan, $this->uid, CURRENT_TIMESTAMP)";
                mysqli_query($this->conn, $query);
                return;
            }
            $row = mysqli_fetch_all($result, MYSQLI_BOTH);
            $query = "INSERT INTO prohelp VALUES ($this->uid, $plan, " . $row[0]['uid'] . ", '', CURRENT_TIMESTAMP)";
            mysqli_query($this->conn, $query);
            $query = "UPDATE gethelp SET times=2 WHERE plan=$plan && uid=" . $row[0]['uid'];
            mysqli_query($this->conn, $query);
            return;
        }
    }

    function upload($plan, $name) {
        $query = "UPDATE prohelp SET picture='$name' WHERE plan=$plan && uid=$this->uid";
        mysqli_query($this->conn, $query);
    }

    function hasUploaded($plan, User $payee) {
        $query = "SELECT * FROM prohelp WHERE plan=$plan && uid=$this->uid && uid2=$payee->uid ORDER BY time ASC";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_all($result, MYSQLI_BOTH);
            return count($row) > 0 ? $row[0]['picture'] : '';
        }
        return 0;
    }

    function istobepayed($plan) {
        $query = "SELECT * FROM gethelp WHERE plan=$plan && uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        return (count($row) > 0) ? true : false;
    }

    function finishcycle($plan) {
        $query = "SELECT * FROM gethelp WHERE plan=$plan && uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($row) > 0) {
            $query = "SELECT * FROM prohelp WHERE plan=$plan && uid2=$this->uid";
            $result = mysqli_query($this->conn, $query);
            if (!$result)
                return;
            $rows = mysqli_fetch_all($result, MYSQLI_BOTH);
            if (count($rows) == 0) {
                if ($row[0]['times'] > 1) {
                    $query = "DELETE FROM gethelp WHERE plan=$plan && uid=$this->uid";
                    mysqli_query($this->conn, $query);
                    $this->addC();
                }
            }
        }
    }

    function decline($plan) {
        $query = "SELECT * FROM prohelp WHERE plan=$plan && uid=$this->uid";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_all($result, MYSQLI_BOTH);
            if (count($row) > 0) {
                if($row[0]['picture']!='') unlink('/home/bueze/public_html/upload/'.$row[0]['picture']);
                if($row[0]['uid2']==1000){
                    $query = "DELETE FROM gethelp WHERE plan=$plan && times=".$row[0]['uid'];
                    mysqli_query($this->conn, $query);
                }else{
                    $query = "UPDATE gethelp SET times=times-1 WHERE plan=$plan && uid=".$row[0]['uid2'];
                    mysqli_query($this->conn, $query);
                }
                $query = "DELETE FROM prohelp WHERE plan=$plan && uid=$this->uid";
                mysqli_query($this->conn, $query);
                $this->finishcycle($plan);
            }
        }
        return 0;
    }

    function confirm($plan, User $payee) {
        $query = "SELECT * FROM prohelp WHERE plan=$plan && uid2=$this->uid && uid=$payee->uid";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_all($result, MYSQLI_BOTH);
            if (count($row) == 1) {
                if($row[0]['picture']!='') unlink('/home/bueze/public_html/upload/'.$row[0]['picture']);
                $query = "INSERT INTO gethelp VALUES(" . $row[0]['uid'] . ", $plan, 0, CURRENT_TIMESTAMP)";
                mysqli_query($this->conn, $query);
                $query = "UPDATE gethelp SET times=times+1 WHERE plan=$plan uid=$this->uid";
                mysqli_query($this->conn, $query);
                $query = "DELETE FROM prohelp WHERE plan=$plan && uid2=$this->uid && uid=$payee->uid";
                mysqli_query($this->conn, $query);
                $this->finishcycle($plan);
            }
        }
        return 0;
    }

    function addref($param) {
        $query = "SELECT * FROM persons WHERE regdate='$param'";
        $result = mysqli_query($this->conn, $query);
        if (!$result)
            return;
        $row = mysqli_fetch_all($result, MYSQLI_BOTH);
        if (count($row) > 0) {
            $query = "UPDATE accounts SET refs=refs+1 WHERE uid=" . $row[0]['uid'];
            mysqli_query($this->conn, $query);
        }
    }

}



