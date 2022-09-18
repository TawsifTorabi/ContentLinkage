<?php
    include_once "dbconnection.php";

    //sql_quary
    $sql = "SELECT client_username,client_password
            from client";

    $result = $conn->query($sql);
    if($result -> num_rows > 0){

        while($rows = $result-> fetch_assoc()){

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(($rows['client_username'] == $_POST['username']) && ($rows['client_password'] == $_POST['password'])){
                    //matched username and password 
                    //now going to client interface
                    ?>
                    
                    <script>window.location.assign('clientinterface.php')</script>

                    <?php

                }else{
                    echo"wrong username or password";
                }
            }

        }
        
    }else{
        echo "No Result Found";
    }


?>