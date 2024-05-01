<?php

session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {


    header("location: ../login.php");
    exit;
}
if ($_SESSION['username'] != 'admin') {
    header("location: ../login.php");
    exit;
}


require_once("../conn.php");
$play = "SELECT * from teams WHERE team LIKE 'rr';";
$number = mysqli_query($conn, $play);
$x = $number->fetch_assoc();
$played = $x['played'];



if (isset($_POST['submit'])) {
    


    
    

    $sql_query = "SELECT * FROM `player_point_1` where team LIKE 'rr';";
    if ($result = $conn->query($sql_query)) {
        while ($row = $result->fetch_assoc()) {
            $player = $row['player'];
            $runs = $_POST["$player-r-$played"];
            $wicket = $_POST["$player-w-$played"];
            $catch = $_POST["$player-c-$played"];
            $motm = $_POST["$player-m-$played"];
            
            $sql_run_update ="UPDATE `player_point_1` SET `r{$played}` = '$runs' WHERE `player_point_1`.`player` = '$player';";
            $sql_wicket_update ="UPDATE `player_point_1` SET `w{$played}` = '$wicket' WHERE `player_point_1`.`player` = '$player';";
            $sql_catch_update ="UPDATE `player_point_1` SET `c{$played}` = '$catch' WHERE `player_point_1`.`player` = '$player';";
            $sql_motm_update ="UPDATE `player_point_1` SET `m{$played}` = '$motm' WHERE `player_point_1`.`player` = '$player';";
            mysqli_query($conn,$sql_run_update);
            mysqli_query($conn,$sql_wicket_update);
            mysqli_query($conn,$sql_catch_update);
            mysqli_query($conn,$sql_motm_update);
            $update = $played+1;
            $sql_update_team ="UPDATE `teams` SET `played` = '$update' WHERE `teams`.`team` = 'rr';";
            mysqli_query($conn,$sql_update_team);
            header("location:../refresh_points.php");

        }
    }


}



?>








<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Admin</title> <title>Admin</title><link rel="icon" type="image/x-icon" href="../images/IPL.webp">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../custom.css">
</head>

<body>
    
    
    <div class="container text-center mt-4">
        <button onclick="location.href='../admin.php'" class="btn btn-primary">ADMIN</button>
    </div> <?php
echo "<h1 class='text-center my-4'>RR MATCH NO {$played}</h1>";
    ?>
    <div class=" container">
        <form action="rr.php" method="post">
            <table class="table table-bordeed">
                <thead>
                    <tr>
                        <th scope="col">Player</th>
                        <th scope="col">Runs - M -
                            <?php echo $played; ?>
                        </th>
                        <th scope="col">Wicket - M -
                            <?php echo $played; ?>
                        </th>
                        <th scope="col">Catch - M -
                            <?php echo $played; ?>
                        </th>
                        <th scope="col">MOTM - M -
                            <?php echo $played; ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("../conn.php");
                    $sql_query = "SELECT * FROM `player_point_1` where team LIKE 'rr';";
                    if ($result = $conn->query($sql_query)) {
                        while ($row = $result->fetch_assoc()) {
                            $player = $row['player'];



                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo "<div class='d-flex text-center justify-content-center align-items-center flex-column'>";

                                    if (file_exists("mi/$player.png")) {

                                        echo "<img style='margin-left:5px;width:10vw;min-width:50px' src='mi/$player.png'>";
                                    } else {
                                        echo "<img style='margin-left:5px;width:10vw;min-width:50px' src='default.png'>";

                                    }


                                    echo $player;
                                    echo "</div>";
                                    ?>
                                </th>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-r-" . $played; ?>"
                                        name="<?php echo $player . "-r-" . $played; ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-w-" . $played; ?>"
                                        name="<?php echo $player . "-w-" . $played; ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-c-" . $played; ?>"
                                        name="<?php echo $player . "-c-" . $played; ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-m-" . $played; ?>"
                                        name="<?php echo $player . "-m-" . $played; ?>" aria-describedby="emailHelp">
                                </td>
                                        

                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>



        <h1 class="text-center">Edit a specific matchday</h1>
        <form method="post" action="team_edit.php">
        <select id="number" name="number" class="form-select" aria-label="Default select example">
            <option selected>Select MatchDay</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
            <option value="5">Five</option>
            <option value="6">Six</option>
                <option value="7">Seven</option>
        </select>

        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Player</th>
                        <th scope="col">Runs
                        </th>
                        <th scope="col">Wicket 
                        </th>
                        <th scope="col">Catch 
                        </th>
                        <th scope="col">MOTM 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("../conn.php");
                    $sql_query = "SELECT * FROM `player_point_1` where team LIKE 'rr';";
                    if ($result = $conn->query($sql_query)) {
                        while ($row = $result->fetch_assoc()) {
                            $player = $row['player'];



                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo "<div class='d-flex text-center justify-content-center align-items-center flex-column'>";

                                    if (file_exists("mi/$player.png")) {

                                        echo "<img style='margin-left:5px;width:10vw;min-width:50px' src='mi/$player.png'>";
                                    } else {
                                        echo "<img style='margin-left:5px;width:10vw;min-width:50px' src='default.png'>";

                                    }


                                    echo $player;
                                    echo "</div>";
                                    ?>
                                </th>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-r-"; ?>"
                                        name="<?php echo $player . "-r-"  ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-w-" ?>"
                                        name="<?php echo $player . "-w-" ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-c-" ?>"
                                        name="<?php echo $player . "-c-" ?>" aria-describedby="emailHelp">
                                </td>
                                <td>
                                    <input value="0" type="number" class="form-control" id="<?php echo $player . "-m-"?>"
                                        name="<?php echo $player . "-m-" ?>" aria-describedby="emailHelp">
                                </td>

                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
                    <input name="team" id="team" class="d-none" value="rr"></input>
        <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>            
       </form>
    </div>
    <?php $team_team = 'rr' ?>      
    <div class="container">
    <?php require "print_table.php"?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>