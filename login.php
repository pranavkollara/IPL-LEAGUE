<?php

$wrongcred = false;
if (isset($_POST['submit'])) {
    require_once("conn.php");
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin123"){
        session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = 'admin';
            header("location: admin.php");
    }


    $sql = "Select * from users where username='$username' AND password='$password'";
    if ($password != "" && $username != "") {
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
           
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: setup.php");
        } else {
            $wrongcred = true;
        }

    }
}
?>


<!doctype html>
<html data-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
    if ($wrongcred) {
        echo '<div class="bg-red-100 border max-w-[85rem] mx-auto border-red-200 text-sm text-red-800 rounded-lg p-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500" role="alert">
        <span class="font-bold">Wrong Password</span> PLease check your password.
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




<form action="login.php" class="" method="post">
        <div class=" mt-3 mx-auto p-4 gap-4 max-w-xl flex flex-col  justify-center items-center">

            <p class="text-2xl mb-4">Login</p>


            <div class="relative w-3/4">

                <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Username</label>
                <div class="relative ">
                    <input type="text" name="username" id="username"
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
                <label for="input-label" class="block text-sm font-medium mb-2 dark:text-white">Password</label>
                <div class="relative">
                    <input id="hs-toggle-password" type="password" name="password" 
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
                    <button type="button" data-hs-toggle-password='{
        "target": "#hs-toggle-password"
      }' class="absolute top-0 end-0 p-3.5 rounded-e-md dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
      <svg class="flex-shrink-0 w-3.5 h-3.5 text-gray-400 dark:text-neutral-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
        <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
        <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
        <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"/>
        <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
        <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"/>
      </svg>
    </button>
                    
                    
                </div>
                

            </div>
            

            
            <button type="submit" id="submit" name="submit"
                class="w-3/4 mt-2 justify-center py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Login</button>
        </div>

    </form>

<!-- <div class="card shrink-0 w-full max-w-sm mx-auto my-auto mt-4 shadow-2xl bg-base-100">
      <form class="card-body" action="login.php" method="post">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Usernmae</span>
          </label>
          <input id="username" name="username" type="text" placeholder="username" class="input input-bordered" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input id="password" name="password" type="password" placeholder="password" class="input input-bordered" required />
          <label class="label">
            <a href="#" class="label-text-alt link link-hover">Forgot password?</a>
          </label>
        </div>
        <div class="form-control mt-6">
          <button name="submit" type="submit" id="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div> -->
    <script src="node_modules/preline/dist/preline.js"></script>

</body>

</html>