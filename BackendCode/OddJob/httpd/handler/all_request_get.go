package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"fmt"
	"math"
	"net/http"
	"strconv"

	"github.com/gin-gonic/gin"
	"github.com/kelvins/geocoder"
)

func AllRequestGet(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		price := c.DefaultQuery("price", "-1")
		task := c.DefaultQuery("task", "-1")
		street := c.DefaultQuery("street", "-1")
		number, err := strconv.Atoi(c.DefaultQuery("number", "-1"))
		if err != nil {
			fmt.Println("Could not get valid street number: ", err)
		}
		city := c.DefaultQuery("city", "-1")
		state := c.DefaultQuery("state", "-1")

		geocoder.ApiKey = "AIzaSyADHmN2wuASiKZGgN7N-tst3bb2GWNKAUk"

		address := geocoder.Address{
			Street:  street,
			Number:  number,
			City:    city,
			State:   state,
			Country: "United States",
		}
		UserLocation, err := geocoder.Geocoding(address)

		if err != nil {
			fmt.Println("Could not get the location: ", err)
		} else {
			fmt.Println("Latitude: ", UserLocation.Latitude)
			fmt.Println("Longitude: ", UserLocation.Longitude)
		}

		queryLoc := "SELECT request_id,number,street,state,city FROM requests WHERE accept_id IS NULL"
		resultsLoc, err := db.Query(queryLoc)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		var reqLocationArray []request.LocationRequest
		for resultsLoc.Next() {
			var requestLoc request.LocationRequest

			err = resultsLoc.Scan(&requestLoc.RequestID, &requestLoc.Number, &requestLoc.Street, &requestLoc.State, &requestLoc.City)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}
			reqLocationArray = append(reqLocationArray, requestLoc)
		}

		var reqID []int
		for _, requestLoc := range reqLocationArray {
			reqAddress := geocoder.Address{
				Street:  requestLoc.Street,
				Number:  requestLoc.Number,
				City:    requestLoc.City,
				State:   requestLoc.State,
				Country: "United States",
			}
			requestLocation, err := geocoder.Geocoding(reqAddress)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}
			if distance(requestLocation.Latitude, requestLocation.Longitude, UserLocation.Latitude, UserLocation.Longitude, "M") < 50 {
				reqID = append(reqID, requestLoc.RequestID)
			}

		}
		queryPart2 := "AND request_id IN ("

		for _, req := range reqID {
			queryPart2 += strconv.Itoa(req) + ","
		}
		fmt.Printf(queryPart2)
		queryPart2 = queryPart2[:len(queryPart2)-1]
		queryPart2 += ")"
		fmt.Printf(queryPart2)

		query := ""
		if price == "-1" {
			if task == "-1" {
				query = "SELECT request_id,title,price,state,city,task,poster_id FROM requests WHERE accept_id IS NULL "
			} else {
				query = "SELECT request_id,title,price,state,city,task,poster_id FROM requests WHERE accept_id IS NULL AND task = " + task + " "
			}
		} else {
			if task == "-1" {
				query = "SELECT request_id,title,price,state,city,task,poster_id FROM requests WHERE accept_id IS NULL AND price < " + price + " "
			} else {
				query = "SELECT request_id,title,price,state,city,task,poster_id FROM requests WHERE accept_id IS NULL AND price < " + price + " AND task = " + task + " "
			}
		}
		totalQuery := query + queryPart2
		results, err := db.Query(totalQuery)
		fmt.Printf(totalQuery)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		var requestArray []request.RequestNoAccepted
		for results.Next() {
			var request request.RequestNoAccepted

			err = results.Scan(&request.RequestID, &request.Title, &request.Price, &request.State, &request.City, &request.Task, &request.UserID)
			if err != nil {
				panic(err.Error()) // proper error handling instead of panic in your app
			}
			requestArray = append(requestArray, request)
		}
		c.JSON(http.StatusOK, requestArray)
	}

}

//Copied from https://www.geodatasource.com/developers/go
func distance(lat1 float64, lng1 float64, lat2 float64, lng2 float64, unit ...string) float64 {
	const PI float64 = 3.141592653589793

	radlat1 := float64(PI * lat1 / 180)
	radlat2 := float64(PI * lat2 / 180)

	theta := float64(lng1 - lng2)
	radtheta := float64(PI * theta / 180)

	dist := math.Sin(radlat1)*math.Sin(radlat2) + math.Cos(radlat1)*math.Cos(radlat2)*math.Cos(radtheta)

	if dist > 1 {
		dist = 1
	}

	dist = math.Acos(dist)
	dist = dist * 180 / PI
	dist = dist * 60 * 1.1515

	if len(unit) > 0 {
		if unit[0] == "K" {
			dist = dist * 1.609344
		} else if unit[0] == "N" {
			dist = dist * 0.8684
		}
	}

	return dist
}
