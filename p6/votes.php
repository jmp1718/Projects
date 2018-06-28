 <?php
 include('./index.php');
                //fetches an array of all the name in the table
                   function fetch_names(){
                        $con = mysqli_connect("localhost","jpacheco2014","XKngTKcxdt","jpacheco2014") or die("Error Conncetion");
                        $sql = "SELECT 'id', 'name' FROM votes";
                        $result = mysql_query($con,$sql);
                        $names = array();

                        while(($row = mysql_fetch_assoc($result)) !== false){
                            $names[$row['id']] = $row['name'];
                        }

                        return $names;
                    }
?>