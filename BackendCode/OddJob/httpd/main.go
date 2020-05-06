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

	db, err := sql.Open("mysql", "b0fc7571f78ffb:b562c8a3@tcp(us-cdbr-iron-east-01.cleardb.net:3306)/heroku_cb680c63ed9989a") //ENTER DATABASE INFO TO CONNECT

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

	/*	Returns all accepted requests for a user
		EXAMPLE:
		http://localhost:8080/allacceptedrequests?user=test1 */
	r.GET("/allacceptedrequests", handler.AllAcceptRequestGet(db))

	/*	Returns a specific available request (Need to provide the requestID in the query)
		EXAMPLE: http://localhost:8080/availablerequest?requestID=81 */
	r.GET("/availablerequest", handler.AvailableRequestGet(db))

	/*	Returns a specific request which has been accepted (Need to provide requestID in the query)
		EXAMPLE: http://localhost:8080/acceptedrequest?requestID=3 */
	r.GET("/acceptedrequest", handler.AcceptedRequestGet(db))

	/*	Updates the database showing that a user has accepted the request
		POST request with these fields
		UserID    string `json:"userid"`
		RequestID int `json:"requestid"`*/
	r.POST("/useracceptedrequest", handler.UserAcceptedRequestGet(db))

	//Adds a new request to the database. Username MUST first be in database
	/*	RequestID int     `json:"rid"`
		Title     string  `json:"title"`
		Post      string  `json:"post"`
		Price     float32 `json:"price"`
		Number    int     `json:"number"`
		Street    string  `json:"street"`
		State     string  `json:"state"`
		City      string  `json:"city"`
		Zipcode   int     `json:"zip"`
		Task      string  `json:"task"`
		Image     string  `json:"image"`
		UserID    string  `json:"userid"` *


	*/
	r.POST("/request", handler.RequestPost(db))

	/*Returns a specific user profile from database (Need to provide userID in query)
	  EXAMPLE: http://localhost:8080/userprofile?username=test1 */
	r.GET("/userprofile", handler.UserGet(db))

	//Adds a new user profile to the database (The rating and backgroundcheck are set to 0 and false respectively)
	/*	Username    string `json:"username"`
		FirstName   string `json:"fname"`
		LastName    string `json:"lname"`
		Email       string `json:"email"`
		State       string `json:"state"`
		City        string `json:"city"`
		PhoneNumber string `json:"phonenum"`
		Image       string `json:"image"` */
	r.POST("/userprofile", handler.UserPost(db))

	/*Archives a request (right after payment)
	request MUST have been accepted beforehand
	EXAMPLE: http://localhost:8080/archiverequest?requestID=71
	*/
	r.GET("/archiverequest", handler.ArchiveReq(db))

	/*Deletes a request
	request MUST NOT have been accepted
	EXAMPLE: http://localhost:8080/deleterequest?requestID=71
	Returns a 204 status if successful (no json returned)*/
	r.GET("/deleterequest", handler.DeleteReq(db))

	/* Performs payment
	POST request needs these json fields
	RequestID int    `json:"requestid"`
	CCNum     string `json:"card_num"`
	CCType    string `json:"card_type"`
	CCExpMon  string `json:"card_month"`
	CCExpYear string `json:"card_year"`
	CVV       string `json:"card_cvv"`
	*/
	r.POST("/paypalPayment", handler.PayPalPayment(db))

	/*Shows all archived requests which were received(requested)
	http://localhost:8080/allarchivedreceived?user=test5*/
	r.GET("/allarchivedreceived", handler.AllArchivedReceived(db))

	/*Shows all archived requests performed
	http://localhost:8080/allarchiveddone?user=jdoe*/
	r.GET("/allarchiveddone", handler.AllArchivedDone(db))

	/*Shows all current requests which the user requested and were accepted
	http://localhost:8080/allrequestsrequestedaccepted?user=test5 */
	r.GET("allrequestsrequestedaccepted", handler.AllRequestsRequestedAccepted(db))

	/*Shows all current requests which the user requested and were accepted
	http://localhost:8080/allrequestsrequestednoaccepted?user=test5*/
	r.GET("allrequestsrequestednoaccepted", handler.AllRequestsRequestedNotAccepted(db))

	r.Run()

}
