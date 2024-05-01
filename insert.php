<?php

require_once("conn.php");
if (isset($_POST['submit'])) {
    $playername = $_POST['playername'];
    
    $team = $_POST['team'];
    
    
    $sql1 ="INSERT INTO `player_point_1` (`player`, `team`) VALUES ('$playername', '$team');";
    $sql2 = "UPDATE player_point_1 SET player = REPLACE(player, \" \", \"_\");";
    mysqli_query($conn,$sql1);
    mysqli_query($conn,$sql2);
    
    
}
?>







<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Admin</title><link rel="icon" type="image/x-icon" href="images/IPL.webp">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="custom.css">
  </head>
  <body>
    <h1 class="text-center mt-4 mb-2">Insert the player</h1>
    <div class="container ">
  <form action="insert.php" method="post">
  <div class="mb-3">
    <label for="player" class="form-label">Player Name</label>
    <input type="text" class="form-control" id="playername" name="playername" aria-describedby="emailHelp">
   
  </div>
  
  <div class="mb-3">
    <label for="team" class="form-label">Team</label>
   
    <select name="team" id="team" class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="csk">CSK</option>
  <option value="mi">MI</option>
  <option value="kkr">KKR</option>
  <option value="rcb">RCB</option>
  <option value="gt">GT</option>
  <option value="srh">SRH</option>
  <option value="rr">RR</option>
  <option value="pbks">PBKS</option>
  <option value="lsg">LSG</option>
  <option value="dc">DC</option>
</select>
  </div>
  
  <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>