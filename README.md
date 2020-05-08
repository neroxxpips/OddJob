Welcome to OddJob!

To install, there are a couple of steps needed.
First, GO is required in order to run the server.
Here's the link to GO: https://golang.org/dl/

Next, open up your command prompt/terminal get to this directory:
C:\Users\*NAME*\BackendCode\OddJob\httpd\

Now, run this command: go run main.go
This will turn on the server, with the host being 'localhost' under port
8080. Now you can do POSTs and GETs.

Next, You must have all PHP, JavaScript, CSS, fonts, and HTML inside a folder
where you can host a server to run PHP, such as XAMPP or WampServer.

Open the index.php file in your browser. You now have access to the website.

-------------------------------------------------------------------------------

All of the Backend code is in the BackendCode folder. The httpd folder has all of
the files that create endpoints, and allows you to call APIs through your localhost.
The platform folder has all of the structs, which are the general structures for the
jsons that are returned when doing queries through the server.

The database login information is found in the main.go file. The database can be accessed
from anywhere because it's hosted on Heroku.
