<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}
$usernameP = $_SESSION['username'];

require_once "conn.php";

$capcheck = "SELECT * from `users` WHERE username LIKE '$usernameP'";
$capcheckp = mysqli_query($conn, $capcheck);
$capcheckx = $capcheckp->fetch_assoc();

if($capcheckx['payment'] == 0 || $capcheckx['team'] == 0){
    header("location:approvalwaiting.php");
}

$sql_query_1 = "SELECT * FROM `users`";
if ($answer = $conn->query($sql_query_1)) {
  while ($output = $answer->fetch_assoc()) {
    $username = $output['username'];
    $ppoint = 0;

    $sql_query = "SELECT * FROM $username";
    if ($result = $conn->query($sql_query)) {
      while ($row = $result->fetch_assoc()) {
        $ppoints = $row['points'];
        $ppoint = $ppoint + $ppoints;
        $point_update = "UPDATE `position` SET `points` = '$ppoint' WHERE `position`.`username` = '$username';";
        mysqli_query($conn, $point_update);

      }
    }
  }
}
require_once("conn.php");


$notification_query = "SELECT * FROM `users` where username like '$username'";
$notification_result = mysqli_query($conn, $notification_query);
$notification_fetch = $notification_result->fetch_assoc();
$notification_value = $notification_fetch['notification'];

function notification_checked($username, $conn)
{

  $notification_update_query = "UPDATE `users` SET `notification` = '0' WHERE username like '$username';";
  mysqli_query($conn, $notification_update_query);
}

if (array_key_exists('button1', $_POST)) {
  notification_checked($username, $conn);
}


?>

<!doctype html>
<html class="dark" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>
  <link rel="stylesheet" href="src/output.css">
</head>

<body class="dark:bg-slate-900">
  <!-- NAVBAR  -->

  <header class=" flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 dark:bg-slate-900">
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between"
      aria-label="Global">
      <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white" href="#">IPL</a>
      <div class="sm:order-3 flex items-center gap-x-2">
        <button type="button"
          class="sm:hidden hs-collapse-toggle inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-white/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          style="padding:0.75rem" data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment"
          aria-label="Toggle navigation">
          <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <line x1="3" x2="21" y1="6" y2="6" />
            <line x1="3" x2="21" y1="12" y2="12" />
            <line x1="3" x2="21" y1="18" y2="18" />
          </svg>
          <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
        <div class="flex" style="gap:0.5rem;">

          <button type="submit"
            class="<?php if ($notification_value == true) {
              echo "animate-wiggle";
            }
            ; ?> py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            data-hs-overlay="#hs-slide-up-animation-modal">

            <svg class=" flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
              <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
            </svg>


          </button>


          <form action="logout.php">

            <button type="submit"
              class="py-2 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-box-arrow-right block md:hidden" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                <path fill-rule="evenodd"
                  d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
              </svg>
              <div class="hidden md:block">Logout</div>
            </button>
          </form>
        </div>
      </div>
      <div id="navbar-alignment"
        class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
        <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
          <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          href="home.php">Home</a>
          <a class="font-medium text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          href="position.php" aria-current="page">Rank</a>
          <a  class="inline-flex items-center gap-x-2 text-sm whitespace-nowrap text-gray-600 hover:text-gray-70 focus:outline-none focus:text-gray-700 opacity-100 pointer-events-none dark:text-gray-500 dark:focus:text-gray-400"
            href="prize.php">Prizepool</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            href="contact.php">Contact us</a>
        </div>
      </div>
    </nav>
  </header>
  <hr class=" max-w-[85rem] mx-auto opacity-40 ">

  <?php
  if ($notification_value == true) {
    ?>
    <!-- NOTIFICATOIN DIV  -->
    <div id="hs-slide-up-animation-modal"
      class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
      <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-14 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div
          class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
          <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
              Notifications
            </h3>
            <form method="post" action="#">

              <button name="button1" value="button1" type="submit"
                class="hs-dropup-toggle flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                data-hs-overlay="#hs-slide-up-animation-modal">
                <span class="sr-only">Close</span>
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M18 6 6 18" />
                  <path d="m6 6 12 12" />
                </svg>
              </button>
            </form>
          </div>
          <div class="p-4 overflow-y-auto">
            <p class="mt-1 text-gray-800 dark:text-gray-400">
              Points have been updated
            </p>
          </div>

        </div>
      </div>
    </div>
    <!-- NOTIFICATOIN DIV  -->

    <?php
  } else {
    ?>

    <div id="hs-slide-up-animation-modal"
      class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
      <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-14 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div
          class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
          <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white">
              Notifications
            </h3>
            <button type="button"
              class="hs-dropup-toggle flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              data-hs-overlay="#hs-slide-up-animation-modal">
              <span class="sr-only">Close</span>
              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
              </svg>
            </button>
          </div>
          <div class="p-4 overflow-y-auto">
            <p class="mt-1 text-gray-800 dark:text-gray-400">
              No new notifications.
            </p>
          </div>

        </div>
      </div>
    </div>

    <?php
  }
  ?>

  <!-- NAVBAR  -->
  <h1 class="text-center mt-2 mb-2 dark:text-white text-2xl">POSITION</h1>
  <div class="mx-auto w-full" style="
     max-width:800px;
      ">
    <div class="flex flex-col overflow-hidden ">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle overflow-hidden">
          <div class="overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">#</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Player</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Team</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Points</th>

                </tr>
              </thead>
              <?php
              $w = 1;
              require_once "conn.php";
              //SELECT * FROM `position` ORDER BY `position`.`points` DESC;
              $sql_query = "SELECT * FROM `position` ORDER BY `position`.`points` DESC";
              if ($result = $conn->query($sql_query)) {
                while ($row = $result->fetch_assoc()) {
                  $player = $row['username'];
                  $point = $row['points'];

                  $realname_query = "SELECT realname FROM users where username like '$player';";
                  $realname_result = $conn->query($realname_query);
                  $name_fetch = $realname_result->fetch_assoc();
                  $name_ = $name_fetch['realname'];

                  $name = $name_;
                  for ($i = 0; $i < strlen($name_); $i++) {
                    if ($name_[$i] == '_') {
                      $name[$i] = ' ';
                    }
                  }

                  ?>

                  <tbody>

                    <?php
                    if ($player == $usernameP) {
                      echo "<tr class='text-green-600'>";
                    } else {
                      echo "<tr>";
                    }
                    ?>


                    <?php
                    if ($player == $usernameP) {
                      echo "<th class='px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-green-600'>";
                    } else {
                      echo "<th class='px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-gray-200'>";
                    }
                    ?>


                    <?php echo $w++; ?>
                    </th>
                    <?php
                    if ($player == $usernameP) {
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 dark:text-green-600'>";
                    } else {
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 dark:text-gray-200'>";
                    }
                    ?>

                    <a href="visit.php?id=<?php echo $player; ?>">

                      <?php echo $name; ?>
                    </a>

                    </td>





                    
                    <td class="flex -space-x-6 justify-center p-2">

                      <?php
                      $query = "SELECT * FROM `$player` ORDER BY `$player`.`points` DESC;";
                      // $query = "SELECT * FROM `$player` ORDER BY `$player`.`captain` DESC, points DESC;";
                      $query_result = mysqli_query($conn, $query);
                      for ($i = 0; $i < 5; $i++) {
                        $list = $query_result->fetch_assoc();
                        $photo_name = $list['player'];
                        $players_team_query = "SELECT * FROM `player_point_1` where player LIKE '$photo_name' ";
                        $player_team_result = mysqli_query($conn, $players_team_query);
                        $team_value = $player_team_result->fetch_assoc();
                        $team_print = $team_value['team'];




                        ?>






                        <?php

                        if ($player == $usernameP) {
                          if (file_exists("teams/$team_print/$photo_name.png")) {
                            echo "<a href='visit.php?id=$player'><img class='inline-block h-[4rem] w-[4rem] rounded-full bg-slate-900 dark:bg-gray-700 ring-2 ring-green-600' src='teams/$team_print/$photo_name.png'
      style='
      max-width:3rem;
      max-height:3rem;
      '
      /></a>";
                          } else {
                            echo "<a href='visit.php?id=$player'><img class='inline-block h-[4rem] w-[4rem] rounded-full bg-slate-900 dark:bg-gray-700 ring-2 ring-green-600' src='teams/default.png'style='
      max-width:3rem;
      max-height:3rem;
      '></a>";
                          }
                        } else {
                          if (file_exists("teams/$team_print/$photo_name.png")) {
                            echo "<a href='visit.php?id=$player'><img class='inline-block h-[4rem] w-[4rem] rounded-full bg-slate-900 dark:bg-gray-700 ring-2 ring-blue-400' src='teams/$team_print/$photo_name.png'
    style='
      max-width:3rem;
      max-height:3rem;
      '
    /></a>";
                          } else {
                            echo "<a href='visit.php?id=$player'><img class='inline-block h-[4rem] w-[4rem] rounded-full bg-slate-900 dark:bg-gray-700 ring-2 ring-lue-400' src='teams/default.png'
    style='
      max-width:3rem;
      max-height:3rem;
      '
    ></a>";
                          }
                        }




                        ?>
                        <?php
                      }
                      ?>

                    </td>
                   
                    <?php
                    if ($player == $usernameP) {
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 dark:text-green-600'><a href='visit.php?id=$player'>";
                    } else {
                      echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 dark:text-gray-200'><a href='visit.php?id=$player'>";
                    }
                    ?>



                    <?php echo $point; ?>
                    </a>
                    </td>

                    </tr>
                    <?php
                }
              }
              ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>




  <script src="node_modules/preline/dist/preline.js"></script>

</body>

</html>