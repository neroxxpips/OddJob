package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func UserAcceptedRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		username := c.DefaultQuery("username", "Guest")
		requestID := c.Query("requestID")

		query := "UPDATE requests SET accept_id = '" + username + "' WHERE request_id = " + requestID

		update, err := db.Query(query)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		update.Close()

		var request request.Request
		query2 := "SELECT * FROM requests WHERE request_id=?"

		err2 := db.QueryRow(query2, requestID).Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.UserID, &request.AcceptorID)
		if err2 != nil {
			panic(err2.Error()) // proper error handling instead of panic in your app
		}
		c.JSON(http.StatusOK, request)

	}
}
