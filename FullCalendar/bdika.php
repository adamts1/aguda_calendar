<body>

    <form method="get" action="http://www.yourwebskills.com/files/examples/process.php">
        
        <select id="cd" name="cd">
        
            <?php
            
            $mysqlserver="localhost";
            $mysqlusername="root";
            $mysqlpassword="";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'adam_project';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
            
            $cdquery="SELECT location FROM events";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from events failed: ".mysql_error());
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
            $location=$cdrow["location"];
                echo "<option>
                    $location
                </option>";
            
            }
                
            ?>
    
        </select>
        
    </form>
    
</body>        