package handler

import (
	"OddJob/platform/user"
	"database/sql"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gin-gonic/gin"
)

type PostUser struct {
	ID          string `json:"id"`
	Password    string `json:"password"`
	FirstName   string `json:"fname"`
	LastName    string `json:"lname"`
	Email       string `json:"email"`
	State       string `json:"state"`
	City        string `json:"city"`
	Zipcode     int    `json:"zip"`
	PhoneNumber string `json:"phonenum"`
}

func UserPost(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {
		requestBody := PostUser{}
		c.Bind(&requestBody)

		user := user.User{
			ID:              requestBody.ID,
			Password:        requestBody.Password,
			FirstName:       requestBody.FirstName,
			LastName:        requestBody.LastName,
			Email:           requestBody.Email,
			State:           requestBody.State,
			City:            requestBody.City,
			Zipcode:         requestBody.Zipcode,
			PhoneNumber:     requestBody.PhoneNumber,
			Rating:          0.0,
			BackgroundCheck: false,
		}
		insert, err := db.Query("INSERT INTO users VALUES ( '" + user.ID + "','" + user.Password + "','" + user.FirstName + "','" + user.LastName + "','" + user.Email + "','" + user.State + "','" + user.City + "'," + strconv.Itoa(user.Zipcode) + ",'" + user.PhoneNumber + "'," + fmt.Sprintf("%g", user.Rating) + ",False )")
		if err != nil {
			panic(err.Error())
		}
		insert.Close()

		c.JSON(http.StatusOK, user)
	}
}
