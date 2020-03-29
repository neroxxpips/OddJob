package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func AllRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		results, err := db.Query("SELECT request_id,title,post,price,poster_id FROM requests WHERE accept_id IS NULL")
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		for results.Next() {
			var request request.Request

			err = results.Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.UserID)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}

			c.JSON(http.StatusOK, request)
		}

	}
}
