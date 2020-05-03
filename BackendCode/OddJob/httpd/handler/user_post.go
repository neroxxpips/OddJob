package handler

import (
	"OddJob/platform/user"
	"database/sql"
	"fmt"
	"net/http"

	"github.com/gin-gonic/gin"
)

type PostUser struct {
	Username    string `json:"username"`
	FirstName   string `json:"fname"`
	LastName    string `json:"lname"`
	Email       string `json:"email"`
	State       string `json:"state"`
	City        string `json:"city"`
	PhoneNumber string `json:"phonenum"`
	Image       string `json:"image"`
}

func UserPost(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {
		requestBody := PostUser{}
		c.Bind(&requestBody)

		user := user.User{
			Username:        requestBody.Username,
			FirstName:       requestBody.FirstName,
			LastName:        requestBody.LastName,
			Email:           requestBody.Email,
			State:           requestBody.State,
			City:            requestBody.City,
			PhoneNumber:     requestBody.PhoneNumber,
			Image:           requestBody.Image,
			Rating:          0.0,
			BackgroundCheck: false,
		}
		insert, err := db.Query("INSERT INTO userprofiles VALUES ( '" + user.Username + "','" + user.FirstName + "','" + user.LastName + "','" + user.Email + "','" + user.State + "','" + user.City + "','" + user.PhoneNumber + "','" + user.Image + "'," + fmt.Sprintf("%g", user.Rating) + ",False )")
		if err != nil {
			panic(err.Error())
		}
		insert.Close()

		c.JSON(http.StatusOK, user)
	}
}
