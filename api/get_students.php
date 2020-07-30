<?php 

require_once("db.php");

 class students {

    function list() {
       $db = new DB();
       $con = $db->connect();
       
       if($con) {
           $stmt = $con->prepare("SELECT * FROM students ORDER BY firstName");
           $stmt->execute();
           // Get students in array of objects
           $allStudents = $stmt->fetchAll();
           
            // Get students in array of arrays
            // $results = array();
            // while($row = $stmt->fetch())
            //     $results[] = [$row["studentID"], $row["firstName"], $row["lastName"], $row["address"], $row["city"], $row["state"], $row["email"]];

            $stmt = null;
            $db->disconnect($con);

            return $allStudents;
        } else 
            return false; 
   }


   function viewStudentAndEnrollments($id) {
     $db = new DB();
     $con = $db->connect();

     if($con) {
        $stmt = $con->prepare("SELECT students.*, courses.*, courses_students.grade FROM students
                              LEFT JOIN courses_students ON students.studentID = courses_students.FKstudents
                              LEFT JOIN courses ON courses.courseID = courses_students.FKcourses
                              WHERE students.studentID = :id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();

         $studentEnrollments = $stmt->fetchAll();
     
        $stmt = null;
        $db->disconnect($con);

        return $studentEnrollments;
     } else
        return false;
   }
 }