package handler

import (
	"OddJob/platform/request"
	"database/sql"
	"fmt"
	"net/http"
	"strconv"

	"github.com/gin-gonic/gin"
)

func ArchiveReq(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		requestid := c.DefaultQuery("requestID", "0")
		var request request.Request
		query := "SELECT request_id,title,post,price,number,street,state,city,zip,task,reqimg,poster_id,accept_id FROM requests WHERE request_id=?"

		err := db.QueryRow(query, requestid).Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.Number, &request.Street, &request.State, &request.City, &request.Zipcode, &request.Task, &request.Image, &request.UserID, &request.AcceptorID)
		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		queryDel := "DELETE FROM requests WHERE request_id =" + strconv.Itoa(request.RequestID)
		del, err := db.Query(queryDel)

		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		del.Close()

		queryIns := "INSERT INTO archived_requests(request_id,title,post,price,number,street,state,city,zip,task,reqimg,poster_id,accept_id) VALUES (" + strconv.Itoa(request.RequestID) + ",'" + request.Title + "','" + request.Post + "'," + fmt.Sprintf("%g", request.Price) + "," + strconv.Itoa(request.Number) + ",'" + request.Street + "','" + request.State + "','" + request.City + "'," + strconv.Itoa(request.Zipcode) + ",'" + request.Task + "','" + request.Image + "','" + request.UserID + "','" + request.AcceptorID + "')"
		ins, err := db.Query(queryIns)

		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		ins.Close()
		c.Status(http.StatusNoContent)
	}
}
