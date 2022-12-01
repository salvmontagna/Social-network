# About
This social network is a university exam project designed for Database and Web Programming and was developed in HTML, CSS, PHP, Javascript and SQL (MariaDB), all pure languages without framework.

## The functionalities
The social network gives you the opportunity to follow the users you appreciate the most, to view their posts and to appreciate them through a like.
There are two REST APIs, such as GIPHY and PIXABAY, which allow you to share multimedia content such as gifs and images.

## ER Model
<p align="center">
  <img width="300" height="400" src="https://www.salvatoremontagna.it/1.png">
</p>
ER model is very simple. A single user can follow other users, he can share posts and like existing ones.

## Interaction between APIs and pages
<p align="center">
  <img src="https://www.salvatoremontagna.it/2.jpg">
</p>
As you can see from the previous section, I've created a database with the tables: user, follower, post and likes. I created some APIs to be able to insert, modify and delete all the data inside the database. I used two REST APIs provided by GIPHY and PIXABAY, both use apiKey as authentication mechanism. I simply obtain from the json the URL of the returned gif/image.

## Installation 
No installation is required. You can just paste the repository on the appropriate web server (like xampp for windows users) and replace:
1) api/conn.php with your database data; 
2) api/do_search_content.php with your pixabay/giphy or other service key;
3) Put your hosting URL on host variable which you can find at the end of the source: create_post.js; home.js; searchusername.js; signup.js.
