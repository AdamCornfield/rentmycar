# rentmycar

# Disclaimer:
All work in this project is my own unless specifically stated otherwise.
This includes all contents within:
bootstrap-grid.css
bootstrap-grid.css.map
bootstrap-utilities.css
bootstrap-utilities.css.map
bootstrap.css

# Version details:
PHP: v8.2.0
Apache: v2.4.54.2
MySQL: v8.0.31
Windows: 10.0.19044 Build 19044

# Installation instructions:
1. Install wamp server, this is used to host the files.
Link can be found here: https://sourceforge.net/projects/wampserver/ or through apps anywhere
2. Unpack rentmycar zip folder
3. Go to http://localhost and select phpmyadmin under the "Your Aliases" section
4. Enter credentials, by default the username will be "root" and there will be no password
5. Click on SQL at the top
6. Copy and paste the contents from the rentmycar.sql file to the Query box on screen and press go at the bottom
7. go back to http://localhost and select "Add a Virtual Host" in the bottom left hand corner of the screen
8. from there set a virtual host name, it can be anything, and then add the absolute path to the root of where you have the rentmycar files
9. then click start at the bottom and wait for a bit
10. once that is done you need to right click on the wamp icon on the system tray at the bottom and go to tools>restart DNS.
11. If you have done everything correctly you should now be able to go to http://localhost again and you will now see a new entry under "Your VirtualHost" for what you set the virtual host name to earlier.
12. You are now loaded into the rentmycar.io website!

# Important notes:
If you are experiencing issues ensure that your credentials to the mysql database is set to root and no password as well as ensuring that the port is set to 3306 (this is the default so unless you have modified it this should not be an issue.)

It is reccomended when using the website to create your own account however for the sake of example the credentials for the test account are username: test password: test

A prehosted demo version will be available for testing at https://rentmycar.cornfield.dev if i am able to get it working correctly.

All code can also be viewed on the github repository here: https://github.com/AdamCornfield/rentmycar