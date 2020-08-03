<?php

require_once("get_students.php");

$sID = $_POST["sID"];
$cID = $_POST["cID"];
$grade = $_POST["grade"];

$student = new students();
$gradeStudent = $student->gradeStudent($sID, $cID, $grade);

header('location: ../students.php');
exit();
?>