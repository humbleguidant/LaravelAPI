# Laravel API
This is a RESTful API created in Laravel. It grabs data from another API in https://pipl.ir/. It also grabs images from https://robohash.org and creates avatars for every new person in the database. After grabbing the data, it stores it into a database table called 'people'. The 'people' table contains personal data such as blood type, age, and so on. This API can also display the 10 newest records from the 'people' table and display statistics on the total number of people in a country, the average age, and so on. 

# Prerequisites
1. PHP 7.1 or Higher <br/>
2. Composer <br/>
3. MySql <br/>
4. Laravel 5.6 or Higher <br/>
5. Postman <br/>

# Understanding the Application 
The API uses four different routes. <br/>
1. POST /person/api_token will create a new person in the database. User must have an API key to create a person. The API key gets passed to middleware() for authorization. Accepts POST requests only <br/> <br/>
2. GET /person/id/api_token Gets the persons record with their ID. User must have API key. ID gets passed to API Controller. Accepts GET requests only. <br/> <br/>
3. GET /person/api_token Gets the ten most recent created people from the database. Accepts GET requests only. <br/> <br/>
4. GET /statistics/api_token Gets statistics of all people in the database including total number of people, average age, and so on. 

# Download Postman
Step 1. Go to https://www.postman.com/downloads/ and choose the desired platform among Mac, Windows or Linux. Click Download. <br /> <br />
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/postman.PNG?raw=true) <br/> <br/>

Step 2. Download is in progress message should now display on the Apps page. Once the Postman download is completed, click on Run. <br /> <br />
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/run.PNG?raw=true) <br/> <br/>

Step 3. Installation Starts <br /> <br />
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/installation.PNG?raw=true) <br/> <br/>

Step 4. In the next window, Signup for a Postman Account <br /> <br />
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/signup.PNG?raw=true) <br/> <br/>

Step 5. Select the workspace tools you need and click Save My Preferences <br /> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/select.PNG?raw=true) <br/> <br/>

Step 6. You will see the startup screen <br /> <br />
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/startup.PNG?raw=true) <br/> <br/>

# Setup the Laravel API
Create a Laravel application. To do this, run the following command in the terminal: <br/> <br/>
$ laravel new api-project <br/> <br/>

Next, create a new database for the application by running: <br/> <br/>
$ mysql -u root -p <br/> <br/>

You will be prompted to type your MySQL password if you have any set when you authenticate with MySQL. Run the following to create a new database named APIPROJECT: <br/> <br/>
CREATE DATABASE APIPROJECT; <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/database.PNG?raw=true) <br/> <br/>

Next, exit mysql and change your current directory to the root folder of the project: <br/> <br/> 
$ cd /path/to/api-project <br/> <br/>

We can proceed to create a model along with a migration. To do this, run: <br/> <br/>
$ php artisan make:model Person -m <br/> <br/>

A new file named Person.php will be created in the app/Models directory. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/person.PNG?raw=true) <br/> <br/>

Additionally, a migration file will be created in the database/migrations directory to generate our table. You will have to modify the migration file as shown below. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/migration.PNG?raw=true) <br/> <br/>

Next, open the project folder in your preferred text editor and modify the .env file to input your proper database credentials. This will allow the application to properly connect to the recently created database: <br/> <br/>
DB_CONNECTION=mysql <br/>
DB_HOST=127.0.0.1 <br/>
DB_PORT=3306 <br/>
DB_DATABASE=your-database-name <br/>
DB_USERNAME=your-database-username <br/>
DB_PASSWORD=your-database-password <br/> <br/>

Add an API key in .env file after the APP_URL parameter. It can be any key that you want. For example: <br/> <br/>

APP_NAME=Laravel <br/>
APP_ENV=local <br/>
APP_KEY=the_app_key <br/>
APP_DEBUG=true <br/>
APP_URL=http://localhost <br/>
API_KEY=the_secret_key <br/> <br/> 

Next, you will run your migration using the following command: <br/> <br/>
$ php artisan migrate <br/> <br/>

# Setup the Middleware
Create an API Key middleware using the make:middleware Artisan command. <br/> <br/>
$ php artisan make:middleware APIkey <br/> <br/>

Add the following code to the handle function in app\Http\Middleware\APIkey.php which checks that the request’s token matches the expected token from the .env file. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/middleware.PNG?raw=true) <br/> <br/>

Register the middleware to the routeMiddleware array in the app/Http/Kernel.php file. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/kernel.PNG?raw=true) <br/> <br/>

# Setup the Routes
Now that we have the basics of the application set up, we can proceed to create a controller that will contain the methods for our API by running: <br/> <br/>
$ php artisan make:controller ApiController <br/> <br/>

You will find a new file named ApiController.php in the app\http\controllers directory. Next, we can add the following methods: <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/controller.PNG?raw=true) <br/> <br/>

Proceed to the routes directory and open the api.php file and create the endpoints that will reference the methods created earlier in the ApiController. Make sure your routes are exactly like the image below. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/routes.PNG?raw=true) <br/> <br/>

# Image Storage
To make images accessible from the web, you should create a symbolic link from public/storage to storage/app/public. Utilizing this folder convention will keep your publicly accessible files in one directory that can be easily shared across deployments. <br /> <br />

To create the symbolic link, you may use the storage:link Artisan command: <br /> <br/>

$ php artisan storage:link <br/> <br/>

The next step is to check the 'public' settings in config/filesystems.php file to save images in the public folder. Make sure your 'public' is the same as the image below. <br/> </br>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/filesystem.PNG?raw=true) <br/> <br/>

Locate the storeImage() method in our ApiController. Make sure you have a storeImage() method as shown below<br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/storeimage.PNG?raw=true) <br/> <br/>

# Install Guzzle Package
The Guzzle HTTP client, allows you to quickly make outgoing HTTP requests to communicate with other web applications. This is for calling the random person API. <br/> <br/> 

Install the Guzzle package: <br/> <br/>
$ composer require guzzlehttp/guzzle <br/> <br/>

# Call Random Person API Function
In the ApiController class, first call the Guzzle class before the controller class, directly under the namespace. <br/> <br/>
use GuzzleHttp\Client; <br/> <br/>

Also call the GuzzleException class after the Guzzle class: <br/> <br/>
use GuzzleHttp\Exception\GuzzleException; <br/> <br/>

Locate the callApi() method in our ApiController. Make sure you have a callApi() function as shown below<br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/callapi.PNG?raw=true) <br/> <br/>


# Create a Person Record
Locate the createPerson() method in our ApiController. It will call the callApi() method to get a random person from the API and create that new person as a new row in the database. The storeImage() method will be called to store an avatar image for that new person. The createPerson() method should look exactly like the image below.  <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/createperson.PNG?raw=true) <br/> <br/>

This method is already tied to the api/person/{api_token} as we previously defined it in our routes file located at routes/api.php: <br/> <br/>
Route::post('person/{api_token}', 'App\Http\Controllers\ApiController@createPerson')->middleware('api_token'); <br/> <br/>

# Testing 
Before testing, make sure your application is running. You can use the inbuilt command as mentioned earlier: <br/> <br/>
$ php artisan serve <br/> <br/>

To test this endpoint, open Postman and make a POST request to http://127.0.0.1:8000/api/person/the_secret_key <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/postmancreateperson.PNG?raw=true) <br/> <br/>

It works if it returns the success message along with the newly created person ID and the 201 response code, Now try adding a few more records to populate our database for the next task.

# Return a Person Record
You will be creating an endpoint to return just a single person record. To begin you have to visit the getPerson() method in the ApiController. We will retrieve a person record by its id and to this, we will be making an eloquent query to return person records by their id. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/getperson.PNG?raw=true) <br/> <br/>

This method is already tied to the api/person/{id}/{api_token} route as we previously defined it in our routes file located at routes/api.php: <br/> <br/>
Route::get('person/{id}/{api_token}', 'App\Http\Controllers\ApiController@getPerson')->middleware('api_token'); <br/> <br/>

# Testing
Open Postman and make a GET request to the /api/person/{id}/{api_token} endpoint {id} can be the id of an existing record you may have in your database. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/postmangetperson.PNG?raw=true) <br/> <br/>

As seen in the image above, We made a request to http://127.0.0.1:8000/api/person/22/the_secret_key and the details of the person assigned to that id were returned. Next, let us try requesting a non-existent person record. <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/noperson.PNG?raw=true) <br/> <br/>

As seen in the image above, a request was made to the endpoint to return the details of the person record with the id of 23 which is non-existent. Our API did a good job by returning an error message along with the 404 status code. <br/> <br/>

# Return Ten Most Recently Added People
Next is to get the ten most recently added people from the database. Go to the getFirstTenPeople() method in our ApiController. It should look exactly like the image below: <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/tenpeople.PNG?raw=true) <br/> <br/>

This method is already tied to the api/person/{api_token} route as we previously defined it in our routes file located at routes/api.php: <br/> <br/>
Route::get('person/{api_token}', 'App\Http\Controllers\ApiController@getFirstTenPeople')->middleware('api_token'); <br/> <br/>

# Testing
Open Postman and make a GET request to the /api/person/{api_token} endpoint.<br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/postmantenpeople.PNG?raw=true) <br/> <br/>

As seen in the image above, we made a request to http://127.0.0.1:8000/api/person/the_secret_key and we got the most recently added people in the database. <br/> <br/>

# Get Statistics of All People
The last step is to get the statistics of all people in the databse incuding a list of all the countries, the average age, and so on. Go to the getStatistics() method in our ApiController. It should look exactly like the image below: <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/getstatistics.PNG?raw=true) <br/> <br/>

This method is already tied to the api/statistics/{api_token} route as we previously defined it in our routes file located at routes/api.php: <br/> <br/>
Route::get('statistics/{api_token}', 'App\Http\Controllers\ApiController@getStatistics')->middleware('api_token'); <br/> <br/>


# Testing
Open Postman and make a GET request to the /api/statistics/{api_token} endpoint.<br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/postmanstats.PNG?raw=true) <br/> <br/>

As seen in the image above, we made a request to http://127.0.0.1:8000/api/statistics/the_secret_key and we get the statistics of all people including list of countries, average aga, and so on. <br/> <br/>

# Conclusion
Now that we have reached the end, let us confirm the contents of some important files. <br/> <br/>
app\http\controllers\ApiController.php <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/controller.PNG?raw=true) <br/> <br/>

routes\api.php <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/routes.PNG?raw=true) <br/> <br/>

app\Models\Person.php <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/person.PNG?raw=true) <br/> <br/>

app\Http\Middleware\APIkey.php <br/> <br/>
![alt text](https://github.com/humbleguidant/LaravelAPI/blob/master/Screenshots/apimiddle.PNG?raw=true) <br/> <br/>


This is a simple RESTful API using Laravel. This covered the basics of the subject matter. 
