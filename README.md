# Attendance-system
made in core php and sql, use of mvc structure and AJAX 

----------------------CONTENTS------------------
1.Overview 
2.code structure
3.database connection

-------------------------------------------------
OVERVIEW : its an attendance application which can be used to take attendance of students varying from class 1 to 12 
the application uses concepts like AJAX and follows a very basic version of MVC design pattern. The MVC pattern is self evident in its folder structure.

CODE STRUCTURE: index.php is where the app starts it operation.
following the MVC design pattern, controller.php is core of the application. using the query string method the controller routes the pages according to the input, after routing to 
a certain a page the graphical reprentation of the page is done using the view method. 
All the database realted action are performed by the pages included under model directory.
javascript directory located under model directory.
CSS directory is located under view folder.

DATABASE CONNECTION: to establish connection to your database , goto model diectory and open 'config.php'.
the config.php file contains the code to establish a database connection with your system.
