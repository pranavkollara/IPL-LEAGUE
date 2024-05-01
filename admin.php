<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {


    header("location: login.php");
    exit;
}
if ($_SESSION['username'] != 'admin') {
    header("location: login.php");
    exit;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Admin</title><link rel="icon" type="image/x-icon" href="images/IPL.webp">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
    
</head>
<body>

    <h1 class="text-center text-decoration-underline mt-2 mb-4">ADMIN</h1>

    <div class="container  border border-3 rounded p-2 d-flex justify-content-around mt-2">
        <div class="container text-center">
            <h2>INSERT PLAYERS</h2>
            <button onclick="location.href='insert.php'" class="text-center btn btn-primary">INSERT</button>
        </div>
        
        <div class="container text-center">
            
            <form class="text-center" action="refresh_points.php">
                <h2>REFRESH SERVER</h2>
                <button class="btn btn-primary" id="submit" type="submit" name="submit"><i class="fa-solid fa-arrows-rotate"></i></button>
            </form>
        </div>

        <div class="container text-center">
            <h2>LOGOUT</h2>
            <button onclick="location.href='logout.php'" class="text-center btn btn-primary">LOGOUT</button>
        </div>
    </div>

    <div class="container border border-3 my-2 rounded">
        
        <h1 class="text-center my-2">INPUT POINTS</h1>
        <div class="d-flex justify-content-evenly  p-2 rounded flex-wrap my-4 container">
            
            <button onclick="location.href=`teams/csk.php`" class="btn my-1 team csk">CSK</button>
            <button onclick="location.href='teams/mi.php'" class="btn my-1 team mi">MI</button>
            <button onclick="location.href='teams/srh.php'" class="btn my-1 team srh">SRH</button>
            <button onclick="location.href='teams/gt.php'" class="btn text-center my-1 team gt">GT</button>
            <button onclick="location.href='teams/kkr.php'" class="btn my-1 team kkr">KKR</button>
            <button onclick="location.href='teams/lsg.php'" class="btn my-1 team lsg">LSG</button>
            <button onclick="location.href='teams/rr.php'" class="btn my-1 team rr">RR</button>
            <button onclick="location.href='teams/rcb.php'" class="btn my-1  team rcb">RCB</button>
            <button onclick="location.href=`teams/pbks.php`" class="btn my-1 team pbks">PBKS</button>
            <button onclick="location.href='teams/dc.php'" class="btn my-1 team dc">DC</button>
        </div>
    </div>
    
    <h1 class="text-center mt-1 mb-2">PLAYER TABLE</h1>
    
    
        
        <div class="container">

        <table class="table table-bordered border border-3 rounded">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Player</th>
                <th scope="col">Team</th>
                <th scope="col">r1</th>
                <th scope="col">w1</th>
                <th scope="col">c1</th>
                <th scope="col">m1</th>
                <th scope="col">r2</th>
                <th scope="col">w2</th>
                <th scope="col">c2</th>
                <th scope="col">m2</th>
                <th scope="col">r3</th>
                <th scope="col">w3</th>
                <th scope="col">c3</th>
                <th scope="col">m3</th>
                <th scope="col">r4</th>
                <th scope="col">w4</th>
                <th scope="col">c4</th>
                <th scope="col">m4</th>
                <th scope="col">r5</th>
                <th scope="col">w5</th>
                <th scope="col">c5</th>
                <th scope="col">m5</th>
                <th scope="col">r6</th>
                <th scope="col">w6</th>
                <th scope="col">c6</th>
                <th scope="col">m6</th>
                <th scope="col">r7</th>
                <th scope="col">w7</th>
                <th scope="col">c7</th>
                <th scope="col">m7</th>
                
            </tr>
        </thead>
        <?php
        $w = 1;
        require_once "conn.php";
        $sql_query = "SELECT * FROM `player_point_1` ORDER BY `player_point_1`.`team` ASC";
        if ($result = $conn->query($sql_query)) {
            while ($row = $result->fetch_assoc()) {
                $player = $row['player'];
                $team = $row['team'];
                $r1 = $row['r1'];
                $w1 = $row['w1'];
                $c1 = $row['c1'];
                $m1 = $row['m1'];
                $r2 = $row['r2'];
                $w2 = $row['w2'];
                $c2 = $row['c2'];
                $m2 = $row['m2'];
                $r3 = $row['r3'];
                $w3 = $row['w3'];
                $c3 = $row['c3'];
                $m3 = $row['m3'];
                $r4 = $row['r4'];
                $w4 = $row['w4'];
                $c4 = $row['c4'];
                $m4 = $row['m4'];
                $r5 = $row['r5'];
                $w5 = $row['w5'];
                $c5 = $row['c5'];
                $m5 = $row['m5'];
                $r6 = $row['r6'];
                $w6 = $row['w6'];
                $c6 = $row['c6'];
                $m6 = $row['m6'];
                $r7 = $row['r7'];
                $w7 = $row['w7'];
                $c7 = $row['c7'];
                $m7 = $row['m7'];
                ?>

<tbody>
    
    <tr>
        <td>
            <?php echo $w++; ?>
        </td>
        <td>
            <?php echo $player; ?>
                        </td>
                        <td>
                            <?php echo strtoupper($team); ?>
                        </td>
                        <td>
                            <?php echo $r1; ?>
                        </td>
                        <td>
                            <?php echo $w1; ?>
                        </td>
                        <td>
                            <?php echo $c1; ?>
                        </td>
                        <td>
                            <?php echo $m1; ?>
                        </td>
                        <td>
                            <?php echo $r2; ?>
                        </td>
                        <td>
                            <?php echo $w2; ?>
                        </td>
                        <td>
                            <?php echo $c2; ?>
                        </td>
                        <td>
                            <?php echo $m2; ?>
                        </td>
                        <td>
                            <?php echo $r3; ?>
                        </td>
                        <td>
                            <?php echo $w3; ?>
                        </td>
                        <td>
                            <?php echo $c3; ?>
                        </td>
                        <td>
                            <?php echo $m3; ?>
                        </td>
                        <td>
                            <?php echo $r4; ?>
                        </td>
                        <td>
                            <?php echo $w4; ?>
                        </td>
                        <td>
                            <?php echo $c4; ?>
                        </td>
                        <td>
                            <?php echo $m4; ?>
                        </td>
                        <td>
                            <?php echo $r5; ?>
                        </td>
                        <td>
                            <?php echo $w5; ?>
                        </td>
                        <td>
                            <?php echo $c5; ?>
                        </td>
                        <td>
                            <?php echo $m5; ?>
                        </td>
                        <td>
                            <?php echo $r6; ?>
                        </td>
                        <td>
                            <?php echo $w6; ?>
                        </td>
                        <td>
                            <?php echo $c6; ?>
                        </td>
                        <td>
                            <?php echo $m6; ?>
                        </td>
                        <td>
                            <?php echo $r7; ?>
                        </td>
                        <td>
                            <?php echo $w7; ?>
                        </td>
                        <td>
                            <?php echo $c7; ?>
                        </td>
                        <td>
                            <?php echo $m7; ?>
                        </td>
                    </tr>
                    <?php
            }
        }
        ?>

</tbody>
</table>
        
    
    
        </div>
    
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/8b22594335.js" crossorigin="anonymous"></script>
</body>

</html>