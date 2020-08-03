<?php

$sID = $_GET["sID"];
$cID = $_GET["cID"];

?>

    <form action="api/studentGraded.php" method="POST">
    
        <input type="hidden" name="sID" value="<?= $sID; ?>">
        <input type="hidden" name="cID" value="<?= $cID; ?>">
        <input type="text" name="grade" placeholder="grade">
        <input type="submit" value="Grade" class="btn-green btn">

    </form>