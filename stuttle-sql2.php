<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
   <title>#devit-skills: SQL Challenge Phase II</title>
   <link rel="stylesheet" type="text/css" href="./stuttle.css" />
   </head>
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
      <?php
         // Connect to database
         // $hostname = "eiffel1.fyre.ibm.com";
         // $username = "devituser";
         // $password = "userpass";
         // $mariadb = "devit";
         // $dbconnect = mysqli_connect($hostname, $username, $password, $mariadb);
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
         <input name="radio" type="radio" value="Q01">      Q01: List all managers by name.<br>
         <input name="radio" type="radio" value="Q02">      Q02: List all employees and their managers.<br>
         <input name="radio" type="radio" value="Q03">      Q03: Identify any inconsistancies/error in the data table (if any).<br>
         <input name="radio" type="radio" value="Q04">      Q04: List the employees who received lowest salary increases in the year 2018.<br>
         <input name="radio" type="radio" value="Q05">      Q05: List the manager who gave the lowest total salary increase (total amount) to his/her team in the year 2018.<br>
         <input name="radio" type="radio" value="Q06">      Q06: List managers and total amount they gave out as salary_increases in the year 2018.<br>
         <input name="radio" type="radio" value="Q07">      Q07: List all employees by name, their manager and salary increases they received in the year 2018.<br>
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
	      case "Q01":
	         echo "<div class=\"a\">";
	         echo "<b>Q01:</b>  List all managers by name.";
                 echo "<br>";
                 echo "<b>A01:</b>  <i>SELECT name FROM employees GROUP BY manager_id ORDER BY name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Name</td>";
                 echo "   </tr>";

                 // Execute A01 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT name FROM employees GROUP BY manager_id ORDER BY name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['name']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q02":
	         echo "<div class=\"a\">";
	         echo "<b>Q02:</b>  List all employees and their managers.";
                 echo "<br>";
                 echo "<b>A02:</b>  <i>SELECT DISTINCT e.name AS Employee, m.manager_id AS reports_to, m.name AS Manager FROM employees e INNER JOIN employees m ON e.id = m.manager_id  ORDER BY m.manager_id, e.name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Manager Name</td>";
                 echo "      <td>Manager Id</td>";
                 echo "      <td>Employee Name</td>";
                 echo "   </tr>";

                 // Execute A02 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT DISTINCT e.name AS Employee, m.manager_id AS reports_to, m.name AS Manager FROM employees e INNER JOIN employees m ON e.id = m.manager_id ORDER BY reports_to, Manager")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['Employee']}</td>
                       <td>{$row['reports_to']}</td>
                       <td>{$row['Manager']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q03":
	         echo "<div class=\"a\">";
	         echo "<b>Q03:</b>  Identify any inconsistancies/error in the data table (if any).";
                 echo "<br>";
                 echo "<b>A03:</b>  <i>To Be Determined</i>";
	         echo "</div>";
	      break;
	      case "Q04":
	         echo "<div class=\"a\">";
	         echo "<b>Q04:</b>  List the employees who received lowest salary increases in the year 2018.";
                 echo "<br>";
                 echo "<b>A04:</b>  <i>SELECT name AS Employee, increase_date AS IncrDate, increase_amount AS Increase FROM employees LEFT JOIN salary_increases ON employees.id = salary_increases.employee_id WHERE salary_increases.increase_date LIKE '2018-%' AND salary_increases.increase_amount = (SELECT MIN(increase_amount) FROM salary_increases) ORDER BY name;</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 echo "<table border=\"1\" align=\"center\">";
                 echo "   <tr>";
                 echo "      <td>Employee Name</td>";
                 echo "      <td>Increase Date</td>";
                 echo "      <td>Increase Amount</td>";
                 echo "   </tr>";

                 // Execute A04 sql_statement
                 $query = mysqli_query($dbconnect, "SELECT name AS Employee, increase_date AS IncrDate, increase_amount AS Increase FROM employees LEFT JOIN salary_increases ON employees.id = salary_increases.employee_id WHERE salary_increases.increase_date LIKE '2018-%' AND salary_increases.increase_amount = (SELECT MIN(increase_amount) FROM salary_increases) ORDER BY name")
                    or die (mysqli_error($dbconnect));

                 // Scroll through result set and display data
                 while ($row = mysqli_fetch_array($query)) {
                    echo
                      "<tr>
                       <td>{$row['Employee']}</td>
                       <td>{$row['IncrDate']}</td>
                       <td>{$row['Increase']}</td>
                      </tr>\n";
                    }
                 echo "</table>";
	      break;
	      case "Q05":
	         echo "<div class=\"a\">";
	         echo "<b>Q05:</b>  List the manager who gave the lowest total salary increase (total amount) to his/her team in the year 2018.";
                 echo "<br>";
                 echo "<b>A05:</b>  <i>To Be Determined</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 // echo "<table border=\"1\" align=\"center\">";
                 // echo "   <tr>";
                 // echo "      <td>Count</td>";
                 // echo "   </tr>";

                 // Execute A05 sql_statement
                 // $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE owners.login_name = 'jroberts'")
                 //    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 // $row = mysqli_fetch_object($query);
                 // echo
                 //   "<tr>
                 //    <td>{$row->mycount}</td>
                 //    </tr>\n";
                 // echo "</table>";
	      break;
	      case "Q06":
	         echo "<div class=\"a\">";
	         echo "<b>Q06:</b>  List managers and total amount they gave out as salary increases in the year 2018.";
                 echo "<br>";
                 echo "<b>A06:</b>  <i>To Be Determined</i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 // echo "<table border=\"1\" align=\"center\">";
                 // echo "   <tr>";
                 // echo "      <td>Count</td>";
                 // echo "   </tr>";

                 // Execute A05 sql_statement
                 // $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN manufacturer ON servers.manufacturer_id = manufacturer.id WHERE manufacturer.name = 'hp'")
                 //    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 // $row = mysqli_fetch_object($query);
                 // echo
                 //   "<tr>
                 //    <td>{$row->mycount}</td>
                 //    </tr>\n";
                 // echo "</table>";
	      break;
	      case "Q07":
	         echo "<div class=\"a\">";
	         echo "<b>Q07:</b>  List all employees by name, their manager and salary increases they received in the year 2018.";
                 echo "<br>";
                 echo "<b>A07:</b>  <i>To Be Determined<i>";
	         echo "</div>";
                 echo "<br>";
                 echo "<br>";
                 // echo "<table border=\"1\" align=\"center\">";
                 // echo "   <tr>";
                 // echo "      <td>Count</td>";
                 // echo "   </tr>";

                 // Execute A07 sql_statement
                 // $query = mysqli_query($dbconnect, "SELECT COUNT(*) AS mycount FROM servers LEFT JOIN owners ON servers.owner_id = owners.id WHERE servers.memory > 32 AND owners.first_name LIKE 'm%'")
                 //    or die (mysqli_error($dbconnect));

                 // Run query and display data
                 // $row = mysqli_fetch_object($query);
                 // echo
                 //   "<tr>
                 //    <td>{$row->mycount}</td>
                 //    </tr>\n";
                 // echo "</table>";
	      break;
	      default:
	         echo "Please select the query you want to run, and click Run Query.";
           }
         }
      ?>
   </body>
</html>
