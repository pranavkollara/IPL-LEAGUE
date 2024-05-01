<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
$username = $_SESSION['username'];

require_once("conn.php");
$bsql = "SELECT build from `users` WHERE username LIKE '$username'";
$bsqlp = mysqli_query($conn, $bsql);
$bsqlx = $bsqlp->fetch_assoc();


if ($bsqlx['build'] == 1) {
    header("location:captain.php");
}


if (isset($_POST['submit'])) {

    $i = 1;
    while ($i < 13) {
        $player = $_POST["player$i"];
        $role = $_POST["role$i"];
        $sql = "INSERT INTO `$username` (`player`,`role`) VALUES ( '$player', '$role');";
        mysqli_query($conn, $sql);
        $i++;
    }

    $bupdate = "UPDATE `users` SET `build` = '1' WHERE username LIKE '$username'";
    mysqli_query($conn, $bupdate);
    header("location: captain.php");

}

?>

<!doctype html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="src/output.css" rel="stylesheet">
</head>

<body class="dark:bg-slate-900">
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 dark:bg-slate-900">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between"
            aria-label="Global">
            <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white" href="#">IPL</a>
            <div class="sm:order-3 flex items-center gap-x-2">
                <button type="button"
                    class="sm:hidden hs-collapse-toggle p-2.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-white/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment"
                    aria-label="Toggle navigation">
                    <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
                <form action="logout.php">

                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        Logout
                    </button>
                </form>
            </div>
            <div id="navbar-alignment"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                    <a class="font-medium text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="home.php" aria-current="page">Home</a>
                    <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="position.php">Rank</a>
                    <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="#">Prizepool</a>
                    <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="#">Contact us</a>
                </div>
            </div>
        </nav>
    </header>






    <!-- <h1 class="text-center">Select Your Players</h1> -->
    <form method="post" action="edit.php">

        <div id="bat" class="flex gap-4 flex-col items-center justify-center">
            <img src="teams/csk/CSK.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player1" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'csk'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }

                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/csk/$player.png")) {
                                                  echo "csk/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php


                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role1" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full w-">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/dc/DC.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player2" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'dc'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/dc/$player.png")) {
                                                  echo "dc/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role2" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/gt/GT.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player3" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'gt'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/gt/$player.png")) {
                                                  echo "gt/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role3" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/kkr/KKR.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player4" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'kkr'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/kkr/$player.png")) {
                                                  echo "kkr/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role4" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/lsg/LSG.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player5" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'lsg'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/lsg/$player.png")) {
                                                  echo "lsg/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role5" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/mi/MI.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player6" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'mi'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/mi/$player.png")) {
                                                  echo "mi/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role6" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/pbks/PBKS.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player7" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'pbks'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/pbks/$player.png")) {
                                                  echo "pbks/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role7" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/rcb/RCB.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player8" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'rcb'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/rcb/$player.png")) {
                                                  echo "rcb/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role8" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/rr/RR.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player9" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'rr'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/rr/$player.png")) {
                                                  echo "rr/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role9" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <img src="teams/srh/SRH.png" class="mx-auto w-20 sm:w-32" alt="">


            <div class="w-3/4 flex justify-between gap-1">

                <div class="w-2/3">


                    <select name="player10" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 WHERE team like 'srh'";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/srh/$player.png")) {
                                                  echo "srh/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role10" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>
            <div class="flex gap-4 items-center">
                <h1 class="text-2xl dark:text-white">Player 11</h1>
                <div class="hs-tooltip ">
                    <button type="button"
                        class="hs-tooltip-toggle w-6 inline-flex justify-center items-center gap-2 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[.05] dark:hover:border-white/[.1] dark:hover:text-white">
                        ?
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700"
                            role="tooltip">
                            Tooltip on top
                        </span>
                    </button>
                </div>
            </div>
            <div class="w-3/4 flex justify-between gap-1">


                <div class="w-2/3">


                    <select name="player11" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1 ";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $team = $row['team'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/$team/$player.png")) {
                                                  echo "$team/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role11" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <div class="flex gap-4 items-center">
                <h1 class="text-2xl dark:text-white">Player 12</h1>
                <div class="hs-tooltip ">
                    <button type="button"
                        class="hs-tooltip-toggle w-6 inline-flex justify-center items-center gap-2 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[.05] dark:hover:border-white/[.1] dark:hover:text-white">
                        ?
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700"
                            role="tooltip">
                            Tooltip on top
                        </span>
                    </button>
                </div>
            </div>
            <div class="w-3/4 flex justify-between gap-1">


                <div class="w-2/3">


                    <select name="player12" data-hs-select='{
                  "hasSearch": true,
                  "searchPlaceholder": "Search...",
                  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                  "placeholder": "Select player...",
                  "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                  "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                }' class="">
                        <option value="" hidden selected disabled>Batsman</option>

                        <?php
                        require_once "conn.php";
                        $sql_query = "SELECT * FROM player_point_1";
                        if ($result = $conn->query($sql_query)) {
                            while ($row = $result->fetch_assoc()) {
                                $player = $row['player'];
                                $team = $row['team'];
                                $print = $player;
                                for ($i = 0; $i < strlen($player); $i++) {
                                    if ($player[$i] == '_') {
                                        $print[$i] = ' ';
                                    }
                                }
                                ?>

                                <option value=<?php echo $player ?> data-hs-select-option='{
                                              "icon": "<img class=\"inline-block w-10 h-10 sm:w-20 sm:h-20 object-cover object-top rounded-full\" src=\"teams/<?php
                                              if (file_exists("teams/$team/$player.png")) {
                                                  echo "$team/$player";
                                              } else {
                                                  echo "default";
                                              }
                                              ?>.png\" />"}'>
                                    <?php echo $print; ?>
                                </option>

                                <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div style="width:calc(33.33% - 1rem);">
                    <select name="role12" data-hs-select='{
                        "hasSearch": true,
                        "searchPlaceholder": "Search...",
                        "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 py-2 px-3",
                        "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-slate-900",
                        "placeholder": "Role",
                        "toggleTag": "<button type=\"button\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-gray-200\" data-title></span></button>",
                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                        "dropdownClasses": "mt-2 max-h-[300px] pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                        "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-gray-200\" data-title></div></div></div>"
                        }' class="w-full">

                        <option value="" hidden selected disabled>Batsman</option>
                        <option value="bat">Batsman</option>
                        <option value="bal">Baller</option>
                        <option value="wk">Wicketkeeper</option>
                        <option value="all">Allrounder</option>


                    </select>
                </div>
            </div>

            <button type="submit" id="submit" name="submit"
                class="mb-4 w-3/4 mt-2 justify-center py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Submit</button>

    </form>

    <script src="node_modules/preline/dist/preline.js"></script>

</body>

</html>