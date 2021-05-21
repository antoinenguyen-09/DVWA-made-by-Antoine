<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            color: #d96459;
            font-family: monospace;
            font-size: 25px;
            text-align:left; 
        }
        th {
            background-color: #d96459;
            color: white; 
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
         <span class="navbar-brand mb-0 h1">
            List of students 
         </span>
    </nav>
    <br/>
       <table>
           <tr>
               <th>ID</th>
               <th>Fullname</th>
               <th>Email</th>
               <th>Phone number</th>
           </tr>
           <?php            
                $con3 = new mysqli("localhost","kali","kali","class");
                if ($con3->connect_error) {
                  die("Connection failed: " . $con3->connect_error);
                }
                $sql = "SELECT id, fullname, email, phonenum FROM student";
                $result = $con3->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<tr><td onclick="load_ajax(this)">'.$row["id"]."</td><td>".$row["fullname"]."</td><td>".$row["email"]."</td><td>".$row["phonenum"]."</td></tr>";
                    }
                } else{
                    $msg = "This class is empty now!";
                }
           ?>
    </table>
    <p><?php if(isset($msg)) echo $msg; ?></p>
    <script>
        function load_ajax(param){
                $.ajax({
                    url : "details.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         td_data : param.innerHTML   // input with id = number
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
    </script>
    <div id="result">
    </div>
</body>
</html>
 