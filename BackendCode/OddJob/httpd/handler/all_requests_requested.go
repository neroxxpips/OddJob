package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func AllRequestsRequestedAccepted(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		userID := c.DefaultQuery("user", "-1")

		query := "SELECT * FROM requests WHERE poster_id = '" + userID + "'AND accept_id IS NOT NULL;"
		results, err := db.Query(query)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		var allReqs requestArr2
		for results.Next() {
			var request request.Request

			err = results.Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.Number, &request.Street, &request.State, &request.City, &request.Zipcode, &request.Task, &request.Latitude, &request.Longitude, &request.Image, &request.UserID, &request.AcceptorID)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}
			allReqs.RequestArray = append(allReqs.RequestArray, request)
		}
		c.JSON(http.StatusOK, allReqs)
	}

}
