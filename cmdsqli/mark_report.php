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
               <th>Mark</th>
           </tr>
           <?php            
                $con = new mysqli(,,,);  // servername, username, password, databasename (database = "class")
                if ($con->connect_error) {
                  die("Connection failed: " . $con->connect_error);
                }
                $sql = 'SELECT id, fullname FROM '.$_GET['classID'];
                $result = $con->query($sql);   
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td id='studentID'>".$row["id"]."</td><td>".$row["fullname"]."</td><td><button onclick='seeMark()'>Check mark</button></td></tr>";
                    }
                } else{
                    $msg = "This class is empty now!";
                }           
           ?>
    </table>
<script>
    function seeMark(){
        var url = new URL(document.location);
        var classID = url.searchParams.get('classID');
        var studentID = document.getElementById('studentID').innerText;
        window.location.replace('http://localhost:4000/mark.php?studentID='+studentID+'&classID='+classID);
    }
</script>
</body>
