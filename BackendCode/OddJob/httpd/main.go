package main

import (
	"OddJob/httpd/handler"
	"database/sql"
	"fmt"

	"github.com/gin-contrib/cors"
	"github.com/gin-gonic/gin"
	_ "github.com/gin-gonic/gin"
	_ "github.com/go-sql-driver/mysql"
)

func main() {
	r := gin.Default()
	r.Use(cors.Default())

	db, err := sql.Open("mysql", "root:Secret-12345@tcp(127.0.0.1:3306)/testStuff") //ENTER DATABASE INFO TO CONNECT

	if err != nil {
		panic(err.Error())
	}

	defer db.Close()

	fmt.Println("Successfully connected to MySQL database")

	//just a test to see if server is working
	r.GET("/ping", handler.PingGet())

	/*	Returns all available requests
		EXAMPLE:
		http://localhost:8080/allavailablerequests?street=%22Pryor%20St%20SW%22&number=30&city=%22Atlanta%22&state=%22Georgia%22
		http://localhost:8080/allavailablerequests?street=%22S%20Broadway%22&number=304&city=%22Los%20Angeles%22&state=%22California%22 */
	r.GET("/allavailablerequests", handler.AllRequestGet(db))

	/*	Returns a specific available request (Need to provide the requestID in the query)
		EXAMPLE: http://localhost:8080/availablerequest?requestID=3 */
	r.GET("/availablerequest", handler.AvailableRequestGet(db))

	/*	Returns a specific request which has been accepted (Need to provide requestID in the query)
		REQUEST NEEDS TO BE ACCEPTED OR 500 ERROR WILL OCCUR (will fix later with error handling)
		EXAMPLE: http://localhost:8080/acceptedrequest?requestID=3 */
	r.GET("/acceptedrequest", handler.AcceptedRequestGet(db))

	/*	Updates the database showing that a user has accepted the request
		UserID    string `json:"userid"`
		RequestID int `json:"requestid"`*/
	r.POST("/useracceptedrequest", handler.UserAcceptedRequestGet(db))

	//Adds a new request to the database. Username MUST first be in database
	/*	Title  string  `json:"title"`
			Post   string  `json:"post"`
			Price  float32 `json:"price"`
			UserID string  `json:"userid"` *


			/
		r.POST("/request", handler.RequestPost(db))

		/*Returns a specific user profile from database (Need to provide userID in query)
		  EXAMPLE: http://localhost:8080/userprofile?username=testuser123 */
	r.GET("/userprofile", handler.UserGet(db))

	//Adds a new user profile to the database (The rating and backgroundcheck are set to 0 and false respectively)
	/*	Username    string `json:"username"`
		FirstName   string `json:"fname"`
		LastName    string `json:"lname"`
		Email       string `json:"email"`
		State       string `json:"state"`
		City        string `json:"city"`
		Zipcode     int    `json:"zip"`
		PhoneNumber string `json:"phonenum"` */
	r.POST("/userprofile", handler.UserPost(db))

	r.Run()

}
