<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
   <title>#devit-skills: SQL Challenge Phase I</title>
   <link rel="stylesheet" type="text/css" href="./stuttle.css" />
   </head>

<!--   <style>
      div.a {
         text-align: center;
      }
      .header img {
        float: left;
        width: 100px;
        height: 100px;
      }
      .header h1 {
        position: relative;
        top: 18px;
        left: 10px;
      }
   </style> -->



   <body>
      <br>
      <!-- <div class="header"> -->
      <div class="header">
         <img src="./img/devitlogo.png" alt="DevIT Logo" />
         <h1>#devit-skills: SQL Challenge</h1>
      </div>
      <br>
      <br>
      <br>
      <!-- <div class="a">
         <h1><img src="img/devitlogo.png" alt="DevIT Logo" height="60" width="60"/img>     #devit-skills: SQL Challenge</h1>
      <br>
      </div> -->

      <?php
         // Connect to database
         // $hostname = "eiffel1.fyre.ibm.com";
         // $username = "devituser";
         // $password = "userpass";
         // $mariadb = "devit";
         $dbhost = getenv("MYSQL_SERVICE_HOST");
         $dbport = getenv("MYSQL_SERVICE_HOST");
         $dbuser = getenv("MYSQL_USER");
         $dbpass = getenv("MYSQL_PASSWORD");
         $dbname = getenv("MYSQL_DATABASE");
         $dbconnect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
	 if ($dbconnect->connect_error) {
	    die("Database connection failed: " . $dbconnect->connect_error);
	 }
      ?>

      <!-- Present Radio button selection of Queries to run -->
      <form action="#" method="post">
         <label class="heading">Select Query to Run:</label><br>
	 <p style="margin-left: 40px">
         <input name="radio" type="radio" value="Q00">      Q00: Print everything as is from the servers table.<br>
         <input name="radio" type="radio" value="Q01">      Q01: Print all server names from the servers table.<br>
         <input name="radio" type="radio" value="Q02">      Q02: Print all servers that start with the letter a.<br>
         <input name="radio" type="radio" value="Q03">      Q03: Print all servers that have more than 32 memory.<br>
         <input name="radio" type="radio" value="Q04">      Q04: Print the number of servers owned by jroberts.<br>
         <input name="radio" type="radio" value="Q05">      Q05: Print the number of hp servers.<br>
         <input name="radio" type="radio" value="Q06">      Q06: Print the number of servers with memory greater than 32 and owned by someone whose name starts with m.<br>
         <input name="radio" type="radio" value="Q07">      Q07: Print all servers that have additional disks.<br>
         <input name="radio" type="radio" value="Q08">      Q08: Print all total memory for all servers.<br>
         <input name="radio" type="radio" value="Q09">      Q09: Print the number of servers created before 4:15 PM on October 29, 2018.<br>
         <input name="radio" type="radio" value="Q10">      Q10: Print the total number of CPU Cores on Dell servers.<br>
	 </p>
	 <input name="submit" type="submit" value="Run Query" />
      </form>

      <?php
         // Get radio button selection
         if (isset($_POST['submit'])) {
            if(isset($_POST['radio']))
            {
               // echo "<span>You have selected :<b> ".$_POST['radio']."</b></span><br>";
	       echo "<br>";
            }
            else{ echo "<span>Please choose any query.</span><br>";}
         }
      ?>

     <?php
        // Run and present query results based on selection
	if(!empty($_POST['radio'])) {
   	   switch ($_POST['radio']) {
	      case "Q00":
	         echo "<div class=\"a\">";
	         echo "<b>Q00:</b>  Print everything as is from the servers table.";
                 echo "<br>";
                 echo "<b>A00:</b>  <i>SELECT * FROM servers;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Id</td>";
                 echo "      <td>Manufacturer Id</td>";
                 echo "      <td>Owner Id</td>";
                 echo "      <td>Server Name</td>";
	         echo "      <td>CPU Cores</td>";
                 echo "      <td>Memory</td>";
                 echo "      <td>Root Disk</td>";
                 echo "      <td>OS Id</td>";
                 echo "      <td>Created</td>";
                 echo "   </tr>";

                 // Execute A00 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT * FROM servers")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['id']}</td>
                       <td>{$row['manufacturer_id']}</td>
                       <td>{$row['owner_id']}</td>
                       <td>{$row['server_name']}</td>
                       <td>{$row['cpu_cores']}</td>
                       <td>{$row['memory']}</td>
                       <td>{$row['root_disk']}</td>
                       <td>{$row['os_id']}</td>
                       <td>{$row['created']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q01":
	         echo "<div class=\"a\">";
	         echo "<b>Q01:</b>  Print all server names from the servers table.";
                 echo "<br>";
                 echo "<b>A01:</b>  <i>SELECT server_name FROM servers ORDER BY server_name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Server Name</td>";
                 echo "   </tr>";

                 // Execute A01 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT server_name FROM servers ORDER BY server_name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['server_name']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q02":
	         echo "<div class=\"a\">";
	         echo "<b>Q02:</b>  Print all servers that start with the letter a.";
                 echo "<br>";
                 echo "<b>A02:</b>  <i>SELECT server_name FROM servers WHERE server_name LIKE 'a%' ORDER BY server_name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Server Name</td>";
                 echo "   </tr>";

                 // Execute A02 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT server_name FROM servers WHERE server_name LIKE 'a%' ORDER BY server_name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['server_name']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q03":
	         echo "<div class=\"a\">";
	         echo "<b>Q03:</b>  Print all servers that have more than 32 memory.";
                 echo "<br>";
                 echo "<b>A03:</b>  <i>SELECT server_name, memory FROM servers WHERE memory > 32 ORDER BY server_name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Server Name</td>";
                 echo "      <td>Memory</td>";
                 echo "   </tr>";

                 // Execute A03 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT server_name, memory FROM servers WHERE memory > 32 ORDER BY server_name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['server_name']}</td>
                       <td>{$row['memory']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q04":
	         echo "<div class=\"a\">";
	         echo "<b>Q04:</b>  Print the number of servers owned by jroberts.";
                 echo "<br>";
                 echo "<b>A04:</b>  <i>SELECT COUNT(*) FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE owners.login_name = 'jroberts';</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Count</td>";
                 echo "   </tr>";

                 // Execute A4 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE owners.login_name = 'jroberts'")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mycount}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      case "Q05":
	         echo "<div class=\"a\">";
	         echo "<b>Q05:</b>  Print the number of hp servers.";
                 echo "<br>";
                 echo "<b>A05:</b>  <i>SELECT COUNT(*) FROM servers LEFT JOIN manufacturer ON servers.manufacturer_id = manufacturer.id WHERE manufacturer.name = 'hp';</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Count</td>";
                 echo "   </tr>";

                 // Execute A05 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN manufacturer ON servers.manufacturer_id = manufacturer.id WHERE manufacturer.name = 'hp'")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mycount}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      case "Q06":
	         echo "<div class=\"a\">";
	         echo "<b>Q06:</b>  Print the number of servers with memory greater than 32 and owned by someone whose name starts with m.";
                 echo "<br>";
                 echo "<b>A06:</b>  <i>SELECT COUNT(*) FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE servers.memory > 32 AND owners.first_name LIKE 'm%';</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Count</td>";
                 echo "   </tr>";

                 // Execute A06 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE servers.memory > 32 AND owners.first_name LIKE 'm%'")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mycount}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      case "Q07":
	         echo "<div class=\"a\">";
	         echo "<b>Q07:</b>  Print all servers that have additional disks.";
                 echo "<br>";
                 echo "<b>A07:</b>  <i>SELECT server_name FROM servers JOIN additional_disks ON servers.id = additional_disks.server_id ORDER BY server_name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Server Name</td>";
                 echo "   </tr>";

                 // Execute A07 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT server_name FROM servers JOIN additional_disks ON servers.id = additional_disks.server_id ORDER BY server_name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['server_name']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q08":
	         echo "<div class=\"a\">";
	         echo "<b>Q08:</b>  Print the total memory for all servers.";
                 echo "<br>";
                 echo "<b>A08:</b>  <i>SELECT SUM(memory) FROM servers;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Memory</td>";
                 echo "   </tr>";

                 // Execute A08 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT SUM(memory) AS mymemory FROM servers")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mymemory}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      case "Q09":
	         echo "<div class=\"a\">";
	         echo "<b>Q09:</b>  Print the number of servers created before 4:15 PM on October 29, 2018.";
                 echo "<br>";
                 echo "<b>A09:</b>  <i>SELECT COUNT(*) FROM servers WHERE created <  '2018-10-29 16:15:00';</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Count</td>";
                 echo "   </tr>";

                 // Execute A09 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers WHERE created < '2018-10-29 16:15:00'")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mycount}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      case "Q10":
	         echo "<div class=\"a\">";
	         echo "<b>Q10:</b>  Print the total number of CPU Cores on Dell servers.";
                 echo "<br>";
                 echo "<b>A10:</b>  <i>SELECT SUM(cpu_cores) FROM servers LEFT JOIN manufacturer ON servers.manufacturer_id = manufacturer.id WHERE manufacturer.name = 'dell';</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>CPU Cores</td>";
                 echo "   </tr>";

                 // Execute A9 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT SUM(cpu_cores) AS mycount FROM servers LEFT JOIN manufacturer ON servers.manufacturer_id = manufacturer.id WHERE manufacturer.name = 'dell'")
                    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 $row = mysqli_fetch_object($query);
                 echo
                   "<tr>
                    <td>{$row->mycount}</td>
                    </tr>\n";
                 echo "</table>";
	      break;
	      default:
	         echo "Please select the query you want to run, and click Run Query.";
           }
         }
      ?>
   </body>
</html>
