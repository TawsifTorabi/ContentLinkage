<?php
            //input filtering function
            function input_filter($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
			  
			  ?>