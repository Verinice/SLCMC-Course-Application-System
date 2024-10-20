<?php

namespace SLCMC\Models;

use SLCMC\Controllers\Database;

class Course extends Database
{
    public function fetchCourses($ids)
    {
        if (count($ids) === 0) {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 5; // courses per page
             $offset = ($page - 1) * $limit;
            // Fetch total number of items
            $totalQuery = $this->db->query('SELECT COUNT(*) FROM courses');
            $total = $totalQuery->fetchColumn();
            $search_query = isset($_GET['q']) ? '%' . $_GET['q'] . '%' : null;

            // Fetch items for the current page
            if(isset($search_query)){
                $stmt = $this->db->prepare("SELECT * FROM courses WHERE name LIKE :name LIMIT :limit OFFSET :offset");
                $stmt->bindParam(':name', $search_query, \PDO::PARAM_STR);
            }else{
                $stmt = $this->db->prepare("SELECT * FROM courses LIMIT :limit OFFSET :offset");
            }
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();

            $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $result = [
                'courses' => $courses,
                'total' => $total,
                'page' => $page,
                'limit' => $limit,
                'totalPages' => ceil($total / $limit),
            ];
            return $result;
        }

        $courses = array();
        // get specific courses
        foreach ($ids as $key => $course_id) {
            $course_id = intval($course_id);
            $sql = "SELECT * FROM courses WHERE course_id='$course_id'";
            $stmt = $this->db->query($sql);
            $courses[$key] = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return $courses;
    }
}
