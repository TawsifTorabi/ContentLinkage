<?php
    include_once "dbconnection.php";

    //sql_quary
    $sql = "SELECT admin_username,admin_password
            from admin";

    $result = $conn->query($sql);
    if($result -> num_rows > 0){

        while($rows = $result-> fetch_assoc()){

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(($rows['admin_username'] == $_POST['adminusername']) && ($rows['admin_password'] == $_POST['adminpassword'])){
                    //matched Admin username and password 
                    //now going to Admin interface
                    ?>
                    
                    <script>window.location.assign('admininterface.php')</script>

                    <?php

                }else{
                    echo"wrong Admin username or password<br>";
                }
            }

        }
        
    }else{
        echo "No Result Found";
    }


?>