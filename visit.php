<?php
session_start();
$id = $_GET['id'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
}
$username = $_SESSION['username'];

require_once("conn.php");

$realname_query = "SELECT realname FROM users where username like '$username';";
$realname_result = $conn->query($realname_query);
$name_fetch = $realname_result->fetch_assoc();
$name_ = $name_fetch['realname'];
$name = $name_;
for ($i = 0; $i < strlen($name_); $i++) {
  if ($name_[$i] == '_') {
    $name[$i] = ' ';
  }
}

$id_realname_query = "SELECT realname FROM users where username like '$id';";
$id_realname_result = $conn->query($id_realname_query);
$id_name_fetch = $id_realname_result->fetch_assoc();
$id_name_ = $id_name_fetch['realname'];
$id_name = $id_name_;
for ($i = 0; $i < strlen($id_name_); $i++) {
  if ($id_name_[$i] == '_') {
    $id_name[$i] = ' ';
  }
}

  


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
  <title></title>

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

          <button type="button"
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
          <a class="font-medium text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            href="home.php" aria-current="page">Home</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            href="position.php">Rank</a>
          <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
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
              CONTENT
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

   <div class="mx-auto w-full" style="
  max-width:800px;
  ">

    <h1 class="text-center text-2xl mt-2 dark:text-white">
      <?php echo $id_name; ?>'s Team
    </h1>


    <div class="flex flex-col overflow-hidden">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle overflow-hidden">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 snap-center">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">#</th>
                  <th scope="col"
                    class="px-6 py-3 text-center sm:text-left text-xs font-medium text-gray-500 uppercase">Player</th>
                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Points</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $w = 1;
              require_once "conn.php";
              $sql_query = "SELECT * FROM `$id` ORDER BY `$id`.`role` ASC ";
              if ($result = $conn->query($sql_query)) {
                while ($row = $result->fetch_assoc()) {
                  $player = $row['player'];
                  $playerrole = $row['role'];
                  $point = 0;


                  if ($playerrole == 'bat') {
                    for ($i = 1; $i < 8; $i++) {
                      //POINTS
              

                      $sql = "SELECT r{$i} from `player_point_1` where player LIKE '$player';";
                      $p = $conn->query($sql);
                      $x = $p->fetch_assoc();

                      //MOTM
                      $motm = "SELECT m{$i} from `player_point_1` where player LIKE '$player';";
                      $motmp = mysqli_query($conn, $motm);
                      $motmx = $motmp->fetch_assoc();
                      $current = $x["r" . $i] * ($motmx["m" . $i] + 1);
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
                      $current = $x["w" . $i] * ($motmx["m" . $i] + 1) * 30;
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
                      $current = ($wicket + $runs) * ($motmx["m" . $i] + 1);
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
                      $current = ($catch + $runs) * ($motmx["m" . $i] + 1);
                      $point = $point + $current;


                    }
                  }







                  $cap = "SELECT captain from `$id` where player LIKE '$player'";
                  $capp = mysqli_query($conn, $cap);
                  $capx = $capp->fetch_assoc();
                  $point = $point * $capx['captain'];

                  $command = "UPDATE `$id` SET `points` = '$point' WHERE `$id`.`player` = '$player';";
                  mysqli_query($conn, $command);

                  $teamsql = "SELECT * from `player_point_1` where player LIKE '$player';";
                  $teamr = mysqli_query($conn, $teamsql);
                  $roww = $teamr->fetch_assoc();
                  $team = $roww["team"];

                  $print = $player;
                  for ($i = 0; $i < strlen($player); $i++) {
                    if ($player[$i] == '_') {
                      $print[$i] = ' ';
                    }
                  }



                  ?>

                  

                    <tr>
                      <th scope="row"
                        class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-gray-200">
                        <?php echo $w++; ?>
                      </th>


                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-start text-gray-800 dark:text-gray-200">
                        <div class="flex-shrink-0 group block">
                          <div class="flex items-center max-[400px]:gap-[0px]  gap-[0.5rem]" >
                            <?php
                            if (file_exists("teams/$team/$player.png")) {
                              echo "<img class='inline-block flex-shrink-0 rounded-lg w-20' src='teams/$team/$player.png' >";
                            } else {
                              echo "<img class='inline-block flex-shrink-0 w-20 rounded-lg' src='teams/default.png'>";
                            }
                            ?>
                            <div class="ms-3">
                              <h3 class="font-semibold text-gray-800 dark:text-white">
                                <?php echo $print; ?>
                              </h3>
                              <p class="text-sm font-medium text-gray-400">
                                <?php echo strtoupper($team); ?>
                                <?php echo " - "; ?>
                                <?php
                                if ($playerrole == 'bat') {
                                  echo "Batsman";
                                } elseif ($playerrole == 'bal') {
                                  echo "Baller";
                                } elseif ($playerrole == 'all') {
                                  echo "All-rounder";
                                } else {
                                  echo "Wicketkeeper";
                                }
                                ;

                                ?>
                              </p>
                            </div>

                          </div>
                        </div>
                        <!-- <div class="flex items-center">
                  <div class="avatar">
                    <div class="max-w-20 w-15 h-15 mask mask-squircle">
                      
                    </div>
                  </div>
                  <div>
                    <div class="font-bold">
                      
                    </div>
                    <div class="text-sm opacity-50">
                      
                    </div>
                  </div> -->
                      </td>

                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-gray-200">
                        <!-- Popover -->
                        <div class="hs-tooltip inline-block [--trigger:click]">
                          <div class="hs-tooltip-toggle block text-center">
                            <button type="button"
                              class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-black hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                              <?php echo $point; ?>
                              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                              </svg>
                            </button>

                            <div
                              class=" p-2 hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs w-full bg-white border border-gray-100 text-start rounded-xl shadow-md dark:bg-gray-800 dark:border-gray-700"
                              role="tooltip">
                              <div class="flex flex-col">
                                <div class="-m-1.5 overflow-x-auto">
                                  <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 ">
                                        <thead>
                                          <tr class="snap-x">
                                            <th scope="col"
                                              class="snap-start px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 1
                                            </th>
                                            <th scope="col"
                                              class="snap-start px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 1
                                            </th>
                                            <th scope="col"
                                              class="snap-start px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 1
                                            </th>
                                            <th scope="col"
                                              class="snap-start px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 1
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 2
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 2
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 2
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 2
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 3
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 3
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 3
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 3
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 4
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 4
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 4
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 4
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 5
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 5
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 5
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 5
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 6
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 6
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 6
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 6
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Run - 7
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">Wicket - 7
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase dark:bg-slate-900">Catch - 7
                                            </th>
                                            <th scope="col"
                                              class="px-6 py-3 text-start text-xs font-medium text-white uppercase">MOTM - 7
                                            </th>
                                            
                                            
                                          </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                          <tr>

                                          <?php
                                            $popover_query="SELECT * from `player_point_1` where player LIKE '$player';";
                                            $popover_result = mysqli_query($conn,$popover_query);
                                            $popover_fetch = $popover_result->fetch_assoc();
                                            $pr1 = $popover_fetch['r1'];
                                            $pw1 = $popover_fetch['w1'];
                                            $pc1 = $popover_fetch['c1'];
                                            $pm1 = $popover_fetch['m1'];
                                            $pr2 = $popover_fetch['r2'];
                                            $pw2 = $popover_fetch['w2'];
                                            $pc2 = $popover_fetch['c2'];
                                            $pm2 = $popover_fetch['m2'];
                                            $pr3 = $popover_fetch['r3'];
                                            $pw3 = $popover_fetch['w3'];
                                            $pc3 = $popover_fetch['c3'];
                                            $pm3 = $popover_fetch['m3'];
                                            $pr4 = $popover_fetch['r4'];
                                            $pw4 = $popover_fetch['w4'];
                                            $pc4 = $popover_fetch['c4'];
                                            $pm4 = $popover_fetch['m4'];
                                            $pr5 = $popover_fetch['r5'];
                                            $pw5 = $popover_fetch['w5'];
                                            $pc5 = $popover_fetch['c5'];
                                            $pm5 = $popover_fetch['m5'];
                                            $pr6 = $popover_fetch['r6'];
                                            $pw6 = $popover_fetch['w6'];
                                            $pc6 = $popover_fetch['c6'];
                                            $pm6 = $popover_fetch['m6'];
                                            $pr7 = $popover_fetch['r7'];
                                            $pw7 = $popover_fetch['w7'];
                                            $pc7 = $popover_fetch['c7'];
                                            $pm7 = $popover_fetch['m7'];
                                          ?>



                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr1;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw1;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc1;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm1;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr2;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw2;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc2;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm2;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr3;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw3;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc3;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm3;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr4;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw4;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc4;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm4;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr5;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw5;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc5;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm5;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr6;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw6;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc6;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm6;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pr7;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pw7;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 dark:bg-slate-900">
                                              <?php echo $pc7;?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                              <?php echo $pm7;?>
                                            </td>
                                           
                                          </tr>

                                          
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- End Popover -->

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