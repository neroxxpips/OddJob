package handler

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

type RequestNoAccepted struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	UserID    string  `json:"userid"`
}

func AllRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		results, err := db.Query("SELECT request_id,title,post,price,poster_id FROM requests WHERE accept_id IS NULL")
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		for results.Next() {
			var request RequestNoAccepted

			err = results.Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.UserID)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}

			c.JSON(http.StatusOK, request)
		}

	}
}
