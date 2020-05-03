package handler

import (
	"OddJob/platform/user"
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func UserGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		username := c.DefaultQuery("username", "")

		var user user.User
		query := "SELECT user_id,firstname,lastname,email,state,city,phonenumber,userimg,rating,backgroundcheck FROM userprofiles WHERE user_id=?"

		err := db.QueryRow(query, username).Scan(&user.Username, &user.FirstName, &user.LastName, &user.Email, &user.State, &user.City, &user.PhoneNumber, &user.Image, &user.Rating, &user.BackgroundCheck)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		c.JSON(http.StatusOK, user)
	}
}
