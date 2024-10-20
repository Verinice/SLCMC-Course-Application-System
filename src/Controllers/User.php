<?php

namespace SLCMC\Controllers;

use PDO;
use PDOException;

class User extends Database
{

    public function createUser($user_data)
    {
        new Database;
        $sql = "INSERT INTO users(`admission_number`, `full_name`, `email`, `password`) VALUES(:admission_number, :full_name, :email, :passwd )";
        try {
            $stmt = $this->prepareQuery($sql);
            $adm = $user_data['admission_number'];
            $stmt->bindParam(':admission_number', $adm, PDO::PARAM_INT);
            $stmt->bindParam(':full_name', $user_data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $user_data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':passwd', $user_data['password'], PDO::PARAM_STR);
            // Execute the statement
            $stmt->execute();
            $stmt = $this->prepareQuery("INSERT INTO student_meta(`admission`) VALUES (:admission)");
            $stmt->bindParam(':admission', $adm, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function generateAdm()
    {
        $adm_no = '';
        $length = 4;
        for ($i = 0; $i < $length; $i++) {
            $adm_no .= rand(0, 9);
        }
        return $adm_no;
    }

    public function updateUser($updated_data)
    {
        $queries = array();
        if ($updated_data['type'] == 'kcpe_score') {
            $kcpe_score = intval($updated_data['score']);
            $adm = intval($updated_data['adm']);
            $queries[0] = "UPDATE student_meta SET kcpe_score = '$kcpe_score' WHERE `admission`='$adm'";
        }
        if ($updated_data['type'] == 'kcse_score') {
            $kcpe_score = intval($updated_data['score']);
            $adm = intval($updated_data['adm']);
            $queries[0] = "UPDATE student_meta SET kcse_score = '$kcpe_score' WHERE `admission`='$adm'";
        }
        try {
            $result = $this->execute($queries);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function applyCourse($courses, $adm)
    {
        foreach ($courses as $key => $course_id) {
            $course_id = intval($course_id);
            try {
                $sql = "INSERT INTO applications(`_course_id`, `adm`) VALUES(:_course_id, :adm)";
                $stmt = $this->prepareQuery($sql);
                $stmt->bindParam(':_course_id', $course_id, PDO::PARAM_INT);
                $stmt->bindParam(':adm', $adm, PDO::PARAM_INT);
                // Execute the statement
                $stmt->execute();
                return true;
            } catch (\PDOException $e) {
                return false;
            }
        }
    }
}
