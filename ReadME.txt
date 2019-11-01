Put the WeatherData folder in your WAMPs www folder

To install the DB go into phpMyAdmin and create a database called "weather_data", then while in that db Import the .sql file in this folder.

If you get an error on the home page you probably need to go into the DBConnect.php file in the Models folder and change this line:

$dsn = "mysql:host=localhost;port=3306;dbname=weather_data";

You will need to change the port number to the port your MySQL runs on or possibly just remove it.

Admin Username: Admin
Password: adminpassword