<?php

use SLCMC\Controllers\Database;
use SLCMC\Models\Course;

require "../vendor/autoload.php";

// get form data as array
$form_data = $_POST;

if(!count($form_data)){
    throw new Exception("Error Processing Request: invalid data", 1);
}

// instantiate user and db
new Database;
$courseController = new Course;

// get page
$page = isset($_POST['page']) ? $_POST['page'] : null;

$courses = $courseController->fetchCourses($form_data, $page);

// loginUser
print_r(json_encode(array("courses"=> $courses)));