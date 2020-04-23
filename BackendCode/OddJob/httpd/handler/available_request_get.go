package handler

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

type AvailableRequest struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	Address   string  `json:"address"`
	State     string  `json:"state"`
	City      string  `json:"city"`
	Zipcode   int     `json:"zip"`
	Task      string  `json:"task"`
	UserID    string  `json:"userid"`
}

func AvailableRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		requestid := c.DefaultQuery("requestID", "0")
		var request AvailableRequest
		query := "SELECT request_id,title,post,price,address,state,city,zip,task,poster_id FROM requests WHERE request_id=?"

		err := db.QueryRow(query, requestid).Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.Address, &request.State, &request.City, &request.Zipcode, &request.Task, &request.UserID)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		c.JSON(http.StatusOK, request)
	}
}
