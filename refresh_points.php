<?php
require_once "conn.php";

$sql2 = "UPDATE player_point_1 SET player = REPLACE(player, \" \", \"_\");";
mysqli_query($conn,$sql2);

$sql_query_1 = "SELECT * FROM `users`";
if ($answer = $conn->query($sql_query_1)) {
    while ($output = $answer->fetch_assoc()) {
        $username = $output['username'];
        $ppoint=0;

        $sql_query = "SELECT * FROM $username";
        if ($result = $conn->query($sql_query)) {
            while ($row = $result->fetch_assoc()) {
                $player = $row['player'];
                $playerrole = $row['role'];
                $point = 0;
                



                if ($playerrole == 'bat') {
                    for ($i = 1; $i < 8; $i++) {
                        //POINTS
                        $sql = "SELECT r{$i} from `player_point_1` where player LIKE '$player';";
                        $p = mysqli_query($conn, $sql);
                        $x = $p->fetch_assoc();

                        //MOTM
                        $motm = "SELECT m{$i} from `player_point_1` where player LIKE '$player';";
                        $motmp = mysqli_query($conn, $motm);
                        $motmx = $motmp->fetch_assoc();
                        $current = $x["r" . $i] * ($motmx["m" . $i]+1);
                        $point = $point + $current;


                    }
                } elseif ($playerrole == 'bal') {
                    for ($i = 1; $i < 8; $i++) {
                        //POINTS
                        $sql = "SELECT * from `player_point_1` where player LIKE '$player';";
                        $p = mysqli_query($conn, $sql);
                        $x = $p->fetch_assoc();

                        //MOTM
                        $motm = "SELECT m{$i} from `player_point_1` where player LIKE '$player';";
                        $motmp = mysqli_query($conn, $motm);
                        $motmx = $motmp->fetch_assoc();
                        $current = $x["w" . $i] * ($motmx["m" . $i]+1) * 30;
                        $point = $point + $current;


                    }
                } elseif ($playerrole == 'all') {
                    for ($i = 1; $i < 8; $i++) {
                        //POINTS
                        $sql = "SELECT * from `player_point_1` where player LIKE '$player';";
                        $p = mysqli_query($conn, $sql);
                        $x = $p->fetch_assoc();

                        //MOTM
                        $motm = "SELECT m{$i} from `player_point_1` where player LIKE '$player';";
                        $motmp = mysqli_query($conn, $motm);
                        $motmx = $motmp->fetch_assoc();
                        $wicket = $x["w" . $i] * 30;
                        $runs = $x["r" . $i];
                        $current = ($wicket + $runs) * ($motmx["m" . $i]+1);
                        $point = $point + $current;


                    }
                } else {
                    for ($i = 1; $i < 8; $i++) {
                        //POINTS
                        $sql = "SELECT * from `player_point_1` where player LIKE '$player';";
                        $p = mysqli_query($conn, $sql);
                        $x = $p->fetch_assoc();

                        //MOTM
                        $motm = "SELECT m{$i} from `player_point_1` where player LIKE '$player';";
                        $motmp = mysqli_query($conn, $motm);
                        $motmx = $motmp->fetch_assoc();
                        $catch = $x["c" . $i] * 10;
                        $runs = $x["r" . $i];
                        $current = ($catch + $runs) * ($motmx["m" . $i]+1);
                        $point = $point + $current;


                    }
                }

                $cap = "SELECT captain from `$username` where player LIKE '$player'";
                $capp = mysqli_query($conn, $cap);
                $capx = $capp->fetch_assoc();
                $point = $point * $capx['captain'];

                $command = "UPDATE `$username` SET `points` = '$point' WHERE `$username`.`player` = '$player';";
                mysqli_query($conn, $command);
            }
        }
    }
}

$psql_query_1 = "SELECT * FROM `users`";
if ($panswer = $conn->query($psql_query_1)) {
    while ($poutput = $panswer->fetch_assoc()) {
        $p_username = $poutput['username'];
        $ppoint=0;

        $psql_query = "SELECT * FROM $p_username";
        if ($presult = $conn->query($sql_query)) {
            while ($prow = $presult->fetch_assoc()) {
                $ppoints = $prow['points'];               
                $ppoint = $ppoint + $ppoints;             
                $point_update = "UPDATE `position` SET `points` = '$ppoint' WHERE `position`.`username` = '$username';";
                mysqli_query($conn,$point_update);

            }
        }
    }
}
$notification_update_query = "UPDATE `users` SET `notification` = '1';";
  mysqli_query($conn,$notification_update_query);



header("location:admin.php");
?>