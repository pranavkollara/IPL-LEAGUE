<?php
$added = false;
$userexits = false;
$wrongpass = false;
require_once("conn.php");
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $name = $_POST['name'];
    $date = date('m/d/Y h:i:s', time());
    $table = "CREATE TABLE `cricket`.`$username` (`player` VARCHAR(255) NOT NULL , `role` VARCHAR(10) NOT NULL , `captain` FLOAT(10) NOT NULL DEFAULT '1' , `points` INT(255) NOT NULL , PRIMARY KEY (`player`)) ENGINE = InnoDB;";
    $sql = "INSERT INTO `users` (`realname`, `username`, `password`, `date`) VALUES ('$name','$username', '$password', current_timestamp())";
    $position = "INSERT INTO `position` (`username`) VALUE ('$username')";
    if ($password != "" && $username != "") {
        if ($password == $cpassword) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $userexits = true;
            } else {
                mysqli_query($conn, $sql);
                mysqli_query($conn, $table);
                mysqli_query($conn, $position);
                $sql2 = "UPDATE users SET realname = REPLACE(realname, \" \", \"_\");";
                mysqli_query($conn,$sql2);
                $added = true;

            }
        } else {
            $wrongpass = true;
        }
    }
}



?>

<!doctype html>
<html data-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="src/output.css" rel="stylesheet">
</head>

<body>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 dark:bg-gray-800">
        <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between"
            aria-label="Global">
            <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white" href="#">IPL</a>
            <div class="sm:order-3 flex items-center gap-x-2">

                <button onclick="location.href='login.php'" type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Login
                </button>
                <button onclick="location.href='index.php'" type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Signup
                </button>
            </div>

        </nav>
    </header>
    <hr class="max-w-[85rem] mx-auto">

    <?php
    if ($added) {
        echo '<div id="info-message" class="max-w-[85rem] mx-auto bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
        <span class="font-bold">Success</span> Your account is created.
      </div>
      <script>
        setTimeout(function(){
            // Corrected ID in the following line
            document.getElementById("info-message").style.display = "none";
            /* or
            var item = document.getElementById("info-message");
            item.parentNode.removeChild(item);
            */
        }, 1500);
        </script>';
    }
    if ($userexits) {
        echo '<div id="info-message" class=" max-w-[85rem] mx-auto bg-yellow-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
        <span class="font-bold">User Exists</span> Username already used
      </div>
      <script>
        setTimeout(function(){
            // Corrected ID in the following line
            document.getElementById("info-message").style.display = "none";
            /* or
            var item = document.getElementById("info-message");
            item.parentNode.removeChild(item);
            */
        }, 1500);
        </script>';
    }
    if ($wrongpass) {
        echo '<div id="info-message" class="max-w-[85rem] mx-auto bg-red-100 border border-teal-200 text-sm text-teal-800 rounded-lg p-4 dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
        <span class="font-bold">Alert!</span> Passwords do not match.
      </div>
      <script>
        setTimeout(function(){
            // Corrected ID in the following line
            document.getElementById("info-message").style.display = "none";
            /* or
            var item = document.getElementById("info-message");
            item.parentNode.removeChild(item);
            */
        }, 1500);
        </script>';
    }
    ?>


    <form action="index.php" class="" method="post">
        <div class=" mt-3 mx-auto p-4 gap-4 max-w-xl flex flex-col  justify-center items-center">

            <p class="text-2xl mb-4">Sign Up Form</p>


            <div class="relative w-3/4">

                <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Name</label>
                <div class="relative ">
                    <input type="text" name="name" id="name"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                        placeholder="Enter name">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="relative w-3/4">

                <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Username</label>
                <div class="relative ">
                    <input type="text" name="username" id="username"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                        placeholder="Enter username">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                </div>
            </div>


            <div class="relative w-3/4">
                <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                        placeholder="Enter password">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z" />
                            <circle cx="16.5" cy="7.5" r=".5" />
                        </svg>
                    </div>
                </div>

            </div>
            <div class="relative w-3/4">
                <label for="input-label" class="block text-sm font-medium mb-2 text-left dark:text-white">Confirm
                    Password</label>
                <div class="relative ">
                    <input type="password" name="cpassword" id="cpassword"
                        class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                        placeholder="Enter password">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z" />
                            <circle cx="16.5" cy="7.5" r=".5" />
                        </svg>
                    </div>
                </div>
            </div>

            <label class="label">
                <a href="login.php"
                    class="text-black hover:underline hover:decoration-blue-600 hover:text-blue-600">Already have a
                    account?</a>
            </label>
            <button type="submit" id="submit" name="submit"
                class="w-3/4 justify-center py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Sign
                Up</button>
        </div>

    </form>

    <script src="node_modules/preline/dist/preline.js"></script>
</body>

</html>