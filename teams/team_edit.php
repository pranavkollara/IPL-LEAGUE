<?php
require_once("../conn.php");
if (isset($_POST['submit'])) {
    
    $played = $_POST['number'];
    $team = $_POST['team'];

    
    

    $sql_query = "SELECT * FROM `player_point_1` where team LIKE '$team';";
    if ($result = $conn->query($sql_query)) {
        while ($row = $result->fetch_assoc()) {
            $player = $row['player'];
            $runs = $_POST["$player-r-"];
            $wicket = $_POST["$player-w-"];
            $catch = $_POST["$player-c-"];
            $motm = $_POST["$player-m-"];
            
            $sql_run_update ="UPDATE `player_point_1` SET `r{$played}` = '$runs' WHERE `player_point_1`.`player` = '$player';";
            $sql_wicket_update ="UPDATE `player_point_1` SET `w{$played}` = '$wicket' WHERE `player_point_1`.`player` = '$player';";
            $sql_catch_update ="UPDATE `player_point_1` SET `c{$played}` = '$catch' WHERE `player_point_1`.`player` = '$player';";
            $sql_motm_update ="UPDATE `player_point_1` SET `m{$played}` = '$motm' WHERE `player_point_1`.`player` = '$player';";
            mysqli_query($conn,$sql_run_update);
            mysqli_query($conn,$sql_wicket_update);
            mysqli_query($conn,$sql_catch_update);
            mysqli_query($conn,$sql_motm_update);
            
            
            
        }
    }


}



 header("location:../refresh_points.php");
?>