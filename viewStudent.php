<?php

require_once("api/get_students.php");

$student = new students();
$singleStudent = $student->viewStudentAndEnrollments($_GET['id']);

$studentInformation = $singleStudent[0];

$sStudentDiv = "
        <p data-id>Student ID: $studentInformation[studentID]</p>
        <p data-name>Student name: $studentInformation[firstName] $studentInformation[lastName]</p>
        <p data-email>Student Email: $studentInformation[email]</p>
        <p data-cpr>Student CPR: $studentInformation[cpr]</p>";
$sCourseDiv = '';

foreach($singleStudent as $course) {
    $sCourseDiv .= "
            <p data-course>Course ID: $course[courseID]</p>
            <p data-course>Course title: $course[title]</p>
            <p data-course>Course Startdate: $course[startDate]</p>
            <p data-course>ETCS: $course[ETCS]</p>";
    if($course["courseID"] != null && $course["grade"] == null) {
        $sCourseDiv .= "<p data-grade>No grade yet</p>";
    } else {
        $sCourseDiv .= "<p data-grade>Grade: $course[grade]</p>";
    }
}

?>

    <div class="studentInformation">
        <div class="information">
            <h2>Student</h2>
            <?= $sStudentDiv; ?> 
        </div>
        <div class="courseInformation">
            <h2>courses</h2>
            <?= $sCourseDiv; ?>
        </div>
        <div class="adminOptions"> 
            <button class="btn-blue btn">Edit</button>
            <button class="deleteStudent btn-red btn">Delete</button>
        </div>
    </div>