# Camagru---Docker-Edition

A project from the school 42. In this project I'm supposed to make an instagram-like website. 

Camagru offers you to create a small web application allowing you to make basic basic montages using your webcam and predefined images.
A user of your site should be able to select an image from a list of overlapping images (e.g. frames or objects of dubious utility), take a picture from their webcam and admire the result in a James Cameron-like montage.
All images taken must be public, like-able and commentable.

But there's more, the project is supposed to be containerizable, so I had to implement a solution with Docker. 
You should be able to see the website working with a few lines of code.

First, you should download and install docker, for that I'm going to redirect you here : https://docs.docker.com/get-docker/. 
No matter your OS, you should be able to install docker easily and quickly, just follow the instructions.
Also, you will need to install docker compose. Link here : https://docs.docker.com/compose/install/.

Then it's time to clone this repository, open a command prompt and go to said repository where you cloned it.
Here, you just need to write the following command : (sudo) docker-compose up. 
Some downloads may occur, this is necessary to build and launch all the containers.

When this is done, you can go to the following adress in your browser of choice : 127.0.0.1:80 Et voilà ! 

Note that the emails sent by the website are sent directly to MailHog, one of the container used for this project. 
You can access the emails by going to this adress : 127.0.0.1:8025.

Also, in order to have a full view of what's happening in the database, phpmyadmin is also one of the container.
You can acess it with the adress : 127.0.0.1:8080.
