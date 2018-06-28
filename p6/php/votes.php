 <?php
                //fetches an array of all the name in the table
                function fetch_names(){
                    $sql = "SELECT 'id', 'name' FROM 'votes'";
                    $result = mysql_query($sql);
                    $names = array();

                    while(($row = mysql_fetch_assoc($result)) !== false){
                        $names[$row['id']] = $row['name'];
                    }

                    return $names;
                }
?>