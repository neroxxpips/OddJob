package main

import (
	"OddJob/httpd/handler"
	"database/sql"
	"fmt"

	"github.com/gin-gonic/gin"
	_ "github.com/gin-gonic/gin"
	_ "github.com/go-sql-driver/mysql"
)

func main() {
	r := gin.Default()

	db, err := sql.Open("mysql", "root:Secret-12345@tcp(127.0.0.1:3306)/testStuff") //ENTER DATABASE INFO TO CONNECT

	if err != nil {
		panic(err.Error())
	}

	defer db.Close()

	fmt.Println("Successfully connected to MySQL database")

	r.GET("/ping", handler.PingGet())

	r.GET("/allavailablerequests", handler.AllRequestGet(db))

	r.GET("/availablerequest", handler.AvailableRequestGet(db))

	r.GET("/acceptedrequest", handler.AcceptedRequestGet(db))

	r.GET("/useracceptedrequest", handler.UserAcceptedRequestGet(db))

	r.POST("/request", handler.RequestPost(db))

	r.GET("/user", handler.UserGet(db))
	r.POST("/user", handler.UserPost(db))

	r.Run()

}
