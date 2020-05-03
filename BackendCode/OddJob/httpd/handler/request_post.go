package handler

import (
	"database/sql"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gin-gonic/gin"
	"github.com/kelvins/geocoder"
)

type PostRequest struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	Number    int     `json:"number"`
	Street    string  `json:"street"`
	State     string  `json:"state"`
	City      string  `json:"city"`
	Zipcode   int     `json:"zip"`
	Task      string  `json:"task"`
	Image     string  `json:"image"`
	UserID    string  `json:"userid"`
}

func RequestPost(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {
		requestBody := PostRequest{}
		c.Bind(&requestBody)

		req := PostRequest{
			Title:   requestBody.Title,
			Post:    requestBody.Post,
			Price:   requestBody.Price,
			Number:  requestBody.Number,
			Street:  requestBody.Street,
			State:   requestBody.State,
			City:    requestBody.City,
			Zipcode: requestBody.Zipcode,
			Task:    requestBody.Task,
			Image:   requestBody.Image,
			UserID:  requestBody.UserID,
		}

		geocoder.ApiKey = "AIzaSyADHmN2wuASiKZGgN7N-tst3bb2GWNKAUk"

		address := geocoder.Address{
			Street:  req.Street,
			Number:  req.Number,
			City:    req.City,
			State:   req.State,
			Country: "United States",
		}
		UserLocation, err := geocoder.Geocoding(address)

		lat := fmt.Sprintf("%f", UserLocation.Latitude)
		long := fmt.Sprintf("%f", UserLocation.Longitude)
		//Add item somewhere. Database etc.
		insert, err := db.Query("INSERT INTO requests(title,post,price,number,street,state,city,zip,task,latitude,longitude,reqimg,poster_id) VALUES ( '" + req.Title + "','" + req.Post + "'," + fmt.Sprintf("%g", req.Price) + "," + strconv.Itoa(req.Number) + ",'" + req.Street + "','" + req.State + "','" + req.City + "'," + strconv.Itoa(req.Zipcode) + ",'" + req.Task + "', " + lat + "," + long + ",'" + req.Image + "','" + req.UserID + "')")
		if err != nil {
			panic(err.Error())
		}
		insert.Close()
		c.Status(http.StatusNoContent)
	}
}
