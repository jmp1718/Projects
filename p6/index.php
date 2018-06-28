<?php
require_once './php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Popular Baby Names</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 20px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

</head>

<body>

    <!-- Page Content -->
    <div class="container">
    	<center><h1>Most Popular Baby Names for 2015</h1></center>

        <?php
    		$createStmt = 'CREATE TABLE `babynames` (' . PHP_EOL
            . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
            . '  `sex` varchar(1) DEFAULT NULL,' . PHP_EOL
            . '  `popularity` int(255),' . PHP_EOL 
            . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . PHP_EOL
            . '  PRIMARY KEY (`id`)' . PHP_EOL
            . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
                
             if($db->query($createStmt)) {
                echo '        <div class="alert alert-success">Table creation successful.</div>' . PHP_EOL;

    			  $db->query("LOAD DATA LOCAL INFILE '/home/jpacheco2014/public_html/p4/php/yob2015.txt' INTO TABLE babynames FIELDS TERMINATED BY ',';");}

    		
 		?>
       
        <div>
            <div class = "left">
                <table align = "center">
                    <tr class = "boy-header"><th>NAME</th><th>POPULARITY</th>
                    <?php
                    //connects to the database and retrives names
                    $con = mysqli_connect("localhost","jpacheco2014","XKngTKcxdt","jpacheco2014") or die("Error Conncetion");  
                    $query = "select * from babynames where sex = 'M'";
                    $result = mysqli_query($con,$query);
                    // outputs the names and popularity
                    while($row = mysqli_fetch_array($result)){
                    echo "<tr>
                            <td>".$row["name"]."</td>
                            <td>".$row["popularity"]."</td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div>
            <div class = "right">
                <table align="center">
                    <tr class ="girl-header"><th>NAME</th><th>POPULARITY</th>
                    <?php
                    //connects to the database and retrives names
                    $con = mysqli_connect("localhost","jpacheco2014","XKngTKcxdt","jpacheco2014") or die("Error Connection");
                    $query = "select * from babynames where sex = 'F'";
                    $result = mysqli_query($con,$query);
                    // outputs the names and popularity
                    while($row = mysqli_fetch_array($result)){
                    echo "<tr>
                         <td>".$row["name"]."</td>
                         <td>".$row["popularity"]."</td>
                        </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <center><h1> Vote For Your Favorite Name!<h1></center>
                   <?php
                    $createStmt = 'CREATE TABLE `votes` (' . PHP_EOL
                       . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
                       . '  `gender` varchar(1),' . PHP_EOL 
                       . '  `vote` int(255),' . PHP_EOL 
                       . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . PHP_EOL
                       . '  PRIMARY KEY (`id`)' . PHP_EOL
                       . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
                           
                        if($db->query($createStmt)) {
                           echo '        <div class="alert alert-success">Table creation successful.</div>' . PHP_EOL;}                    
                    ?>
                    <?php
                        if(isset($_POST['vote'])) // for data to be inserted to the votes table 
                            {
                                $name=$_POST['name'];
                                $gender=$_POST['gender'];
                                $connect = mysqli_connect("localhost","jpacheco2014","XKngTKcxdt","jpacheco2014") or die("Error Conncetion");
                                $query1 = "INSERT INTO 'votes' VALUES ('$name','$gender')";
                                $result = mysqli_query($connect,$query1);
                                if($result)
                                {
                                 echo 'Data Inserted';
                                }
                                else{ echo 'Data Not Inserted';}

                            }
                     ?>
                        <form action="index.php" method="post" align = "center">
                            <label>Enter your favorite name:</label>
                            <input type="text" name="name" placeholder="Favorite Name"/>
                            <select name="gender">
                                    <option value="M">Male</option>
                                    <option Value="F">Female</option>
                            </select>
                            <input type="submit" name="vote">
                        </form>
                   
    <table align = "center"> <! -- displays table to show favorite names-->
                <?php
                    //connects to the database and retrives names
                    $con = mysqli_connect("localhost","jpacheco2014","XKngTKcxdt","jpacheco2014") or die("Error Conncetion");
                    $query = "select * from votes";
                    $result = mysqli_query($con,$query);
                    // outputs the names and popularity
                    while($row = mysqli_fetch_array($result)){
                    echo "<tr>
                            <td>".$row["name"]."</td>
                            <td>".$row["vote"]."</td>
                        </tr>";
                    }
                ?>
    </table>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
