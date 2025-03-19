<?php
$host = "localhost";
$user = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $user, $password) or die ("Error: no connection can be made to the host");

mysqli_select_db($link, $database) or die ("Error: the database could not be opened");

$query = "SELECT * FROM customer";
$result = mysqli_query($link, $query) or die ("Error: an error has occurred while executing the query");

echo("<h2>Customers</h2>");
$numberRecords = mysqli_num_rows($result);
echo("<table><tr><th>id</th><th>firstname</th><th>lastName</th><th>admin</th><th>active</th><th>email</th><th>username</th><th>password</th><th>phone</th><th>date</th></tr>");
while($row = mysqli_fetch_array($result))
{
    echo("<tr><td>".$row['customerID']."</td><td>".$row['firstName']."</td><td>".$row['lastName']."</td><td>".$row['admin']."</td><td>".$row['active']."</td><td>".$row['email']."</td><td>".$row['username']."</td><td>".$row['password']."</td><td>".$row['phoneNbr']."</td><td>".$row['birthdate']."</td>");
}

echo("</table>");
mysqli_close($link)
?>