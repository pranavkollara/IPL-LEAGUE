<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
$username = $_SESSION['username'];

require_once("conn.php");
$capcheck = "SELECT * from `users` WHERE username LIKE '$username'";
$capcheckp = mysqli_query($conn, $capcheck);
$capcheckx = $capcheckp->fetch_assoc();

if($capcheckx['payment'] == 1 && $capcheckx['team'] == 1){
    header("location:home.php");
}

if (isset($_POST['submit'])) {
    require_once("conn.php");
   
    
        $captain = $_POST["captain"];
        $vcaptain = $_POST["vcaptain"];
        $csql = "UPDATE `$username` SET `captain` = '2' WHERE `$username`.`player` = '$captain';";
        $vcsql = "UPDATE `$username` SET `captain` = '1.5' WHERE `$username`.`player` = '$vcaptain';";
        mysqli_query($conn, $csql);
        mysqli_query($conn, $vcsql);
        
        $cupdate ="UPDATE `users` SET `capbuild` = '1' WHERE username LIKE '$username'";
        mysqli_query($conn,$cupdate);
    header("location: home.php");

}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="src/output.css">
</head>

<body>
<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4 dark:bg-gray-800">
  <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between" aria-label="Global">
    <a class="sm:order-1 flex-none text-xl font-semibold dark:text-white" href="#">IPL</a>
    <div class="sm:order-3 flex items-center gap-x-2">
      <button type="button" class="sm:hidden hs-collapse-toggle p-2.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-white/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment" aria-label="Toggle navigation">
        <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
      <form action="logout.php">

          <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
              Logout
            </button>
        </form>
    </div>
    <div id="navbar-alignment" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
      <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
        <a class="font-medium text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="home.php" aria-current="page">Home</a>
        <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="position.php">Rank</a>
        <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">Prizepool</a>
        <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="contact.php">Contact us</a>
      </div>
    </div>
  </nav>
</header>


<div class="container mt-4">
    <h1 class="text-center text-2xl mt-10 mb-4">Waiting for approval of payment and team</h1>
    <h1 class="text-center text-2xl my-4">If paid send screenshot of payment to <a class="text-green-600 underline decoration-blue-600 hover:opacity-80" href="https://wa.me/9867677284">send here</a></h1>
    <h1 class="text-center text-2xl my-4">Will be Approved and notified within 12 hours</h1>
    <h1 class="text-center text-2xl my-4">If you havent paid already pay using the QR below or through the phone number provided</h1>
    <h1 class="text-center text-2xl my-4">Pay to +91 9867677284</h1>
    </div>  
    
        <img class="text-center mx-auto" src="ShauryaGpay.jpg" alt="...">
    

    <script src="node_modules/preline/dist/preline.js"></script>

</body>

</html>