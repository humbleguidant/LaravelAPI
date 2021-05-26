# Laravel API
This is a RESTful API created in Laravel. It grabs data from another API in https://pipl.ir/. After grabbing the data, it stores it into a database table called 'people'. The 'people' table contains personal data such as blood type, age, and so on. This API can also display the 10 newest records from the 'people' table and display statistics on the total number of people in a country, the average age, and so on. To test this API, we must download Postman if you dont have it already. 

# Understanding the Application 
The API uses four different routes. <br/>
1. POST /person/api_token will create a new person in the database. User must have an API key to create a person. The API key gets passed to middleware() for authorization. Accepts POST requests only <br/>
2. GET /person/id/api_token Gets the persons record with their ID. User must have API key. ID gets passed to API Controller. Accepts GET requests only. <br/>
3.  

# Prerequisites
1. PHP 7.1 or Higher <br/>
2. Composer <br/>
3. MySql <br/>
4. Laravel 5.6 or Higher <br/>
5. Postman <br/>

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
