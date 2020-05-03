package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

type AcceptedRequest struct {
	UserID    string `json:"userid"`
	RequestID int    `json:"requestid"`
}

func UserAcceptedRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		requestBody := AcceptedRequest{}
		c.Bind(&requestBody)

		query := "UPDATE requests SET accept_id = '" + requestBody.UserID + "' WHERE request_id = ?"

		update, err := db.Query(query, requestBody.RequestID)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		update.Close()

		var request request.Request
		query2 := "SELECT * FROM requests WHERE request_id=?"

		err2 := db.QueryRow(query2, requestBody.RequestID).Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.Number, &request.Street, &request.State, &request.City, &request.Zipcode, &request.Task, &request.Latitude, &request.Longitude, &request.Image, &request.UserID, &request.AcceptorID)
		if err2 != nil {
			panic(err2.Error()) // proper error handling instead of panic in your app
		}
		c.JSON(http.StatusOK, request)

	}
}
