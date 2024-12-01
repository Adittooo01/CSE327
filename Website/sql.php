
<?php
include "header.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] != "Admin"){
        $message = "Require Admin Access";
        echo "<script>
        alert('$message');
        window.location.href='login.php';
        </script>";
        exit;
    } 
    ?>


<title>SQL</title>

<body>
    <div class="container p-5 my-5 bg-light opacity-75 border-info card h-100 border border-5 table-responsive">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="mb-3">
                <!-- <div class="col-25"><label>SQL Query</label></div>
                <div class="col-75"> -->
                <label for="Doctor_Name" class="form-label">SQL Query</label>
                <textarea name="query" class="form-control" placeholder="Wrtie a SQL code to execute" rows="6" cols="10"></textarea>
            </div>
            <div class="container mt-2 text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </form>
        <br> 
        <?php
            if(isset($_POST['submit'])){
                $sql = $_POST['query'];
                include "tableprint.php";
                printTable($sql, $conn);
            }
        ?>
    </div>
</body>
        
</html>