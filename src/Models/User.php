<?php
namespace SLCMC\Models;

use SLCMC\Controllers\Database;

class User extends Database{
    public function showUser($adm)
    {
        $sql = "SELECT t1.*, t2.* FROM users t1 INNER JOIN student_meta t2 ON t1.admission_number = t2.admission WHERE admission_number='$adm'";
        $stmt = $this->db->query($sql);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!is_countable($user) || count($user) == 0) {
            return array("error" => "No such user found, contact admin");
        }

        // find applications for the user
        $sql = "SELECT t1.*, t2.* FROM applications t1 INNER JOIN courses t2 ON t1._course_id = t2.course_id WHERE adm='$adm'";
        $stmt = $this->db->query($sql);
        $applications = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $user['total_courses'] = $applications;

        return $user;
    }

    public function loginUser($user_data)
    {
        $email = $user_data['email'];
        $plain_password = $user_data['password'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        // execute the query and fetch the results
        $stmt = $this->db->query($sql);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!is_countable($user) || count($user) == 0) {
            return array("error" => "No such user found, contact admin");
        }

        // verify password
        $hashedPassword = $user["password"];

        if (!password_verify($plain_password, $hashedPassword)) {
            return array("error" => "Check your credentials and try again");
        }
        return array("error" => null, "adm" => $user['admission_number'], "username" => $user['full_name'], "email" => $user['email']);
    }
}