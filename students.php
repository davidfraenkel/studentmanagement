<?php

    require_once('includes/header.php'); 
    require_once('includes/menu.php');

    // Get all students from get_students api
    require_once("api/get_students.php");

    $student = new students();
    $allStudents = $student->list();

    //Arrays matching students first letter -> Aaron goes in the "A" array
    $alphabeticalArrays  = array();
  
    foreach($allStudents as $student) {
        $firstLetter = substr($student["firstName"], 0 ,1);
        $alphabeticalArrays[$firstLetter][] = $student;
    }



?>

<ul>
    <li><a class="studentLetter" data-category="A" href="#">A</a></li>
    <li><a class="studentLetter" data-category="B" href="#">B</a></li>
    <li><a class="studentLetter" data-category="C" href="#">C</a></li>
    <li><a class="studentLetter" data-category="D" href="#">D</a></li>
    <li><a class="studentLetter" data-category="E" href="#">E</a></li>
    <li><a class="studentLetter" data-category="F" href="#">F</a></li>
    <li><a class="studentLetter" data-category="G" href="#">G</a></li>
    <li><a class="studentLetter" data-category="H" href="#">H</a></li>
    <li><a class="studentLetter" data-category="I" href="#">I</a></li>
    <li><a class="studentLetter" data-category="J" href="#">J</a></li>
    <li><a class="studentLetter" data-category="K" href="#">K</a></li>
    <li><a class="studentLetter" data-category="L" href="#">L</a></li>
    <li><a class="studentLetter" data-category="M" href="#">M</a></li>
    <li><a class="studentLetter" data-category="N" href="#">N</a></li>
    <li><a class="studentLetter" data-category="O" href="#">O</a></li>
    <li><a class="studentLetter" data-category="P" href="#">P</a></li>
    <li><a class="studentLetter" data-category="Q" href="#">Q</a></li>
    <li><a class="studentLetter" data-category="R" href="#">R</a></li>
    <li><a class="studentLetter" data-category="S" href="#">S</a></li>
    <li><a class="studentLetter" data-category="T" href="#">T</a></li>
    <li><a class="studentLetter" data-category="U" href="#">U</a></li>
    <li><a class="studentLetter" data-category="V" href="#">V</a></li>
    <li><a class="studentLetter" data-category="W" href="#">W</a></li>
    <li><a class="studentLetter" data-category="X" href="#">X</a></li>
    <li><a class="studentLetter" data-category="Y" href="#">Y</a></li>
    <li><a class="studentLetter" data-category="Z" href="#">Z</a></li>
</ul>

<div id="allStudentsContainer">
  
</div>

<template class="studentTemplate">
<div class="studentInformation">
        <div class="studentName">
            <p data-name></p>
        </div>     
        <div class="adminOptions"> 
            <button class="viewButton btn-green btn">View</button>
        </div>
    </div>
</template>

<script>

    const unfilteredStudents = <?=  json_encode($allStudents)?>;
    const alphabeticalArrays = <?= json_encode($alphabeticalArrays); ?>;
    const dest = document.querySelector("#allStudentsContainer");
    const studentTemplate = document.querySelector(".studentTemplate");

    // Show all students
    document.addEventListener("DOMContentLoaded", () => {
            unfilteredStudents.forEach(student => {
                let allStudents = new ShowStudents(student.studentID,student.firstName,student.lastName);
                allStudents.showStudentsLetter();            
            });
    });

    // Show students filtered after first letter
    document.querySelectorAll(".studentLetter").forEach(letter => {
        letter.addEventListener("click", () => {
            let studentName = letter.getAttribute("data-category");
            let allStudents = alphabeticalArrays[studentName];
            if(allStudents == undefined) 
                dest.innerHTML = "No student's name begin with that letter";
            else 
            dest.innerHTML = "";
            allStudents.forEach(student => {
                let newStudent = new ShowStudents(student.studentID,student.firstName,student.lastName);
                newStudent.showStudentsLetter();
            });
        });
    });

    
    function ShowStudents(studentID,firstname,lastname) {
        this.studentID = studentID;
        this.firstName = firstname;
        this.lastName = lastname;

        this.showStudentsLetter = function() {
            let clone = studentTemplate.cloneNode(true).content;
            clone.querySelector("[data-name]").textContent = this.firstName + " " + this.lastName;

            clone.querySelector(".viewButton").addEventListener("click", () => {
                    this.showSingleStudent();
                });

            dest.appendChild(clone);
        }

        this.showSingleStudent = function() {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("allStudentsContainer").innerHTML = this.responseText;
                    if(this.responseText && this.readyState == 4 && this.status == 200) {
                        document.querySelector(".deleteStudent").addEventListener("click", () => {
                            deleteStudent(studentID);
                        });              
                    }
                }
            }
            xhttp.open("GET", "viewStudent.php?id=" + this.studentID, true);
            xhttp.send(); 
        }
    }

    async function deleteStudent(studentID) {
        console.log(studentID);
        let oButton = document.querySelector(".deleteStudent");
        let jConnection = await fetch("api/deleteStudent.php?=" + studentID , {
            method: "POST"
        });

        var jResponse = await jConnection.text();

        console.log(jResponse);
    }

</script>
</body>
</html>
 