package handler

import (
	"database/sql"
	"fmt"
	"net/http"

	"github.com/gin-gonic/gin"
)

type PostRequest struct {
	Title  string  `json:"title"`
	Post   string  `json:"post"`
	Price  float32 `json:"price"`
	UserID string  `json:"userid"`
}

func RequestPost(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {
		requestBody := PostRequest{}
		c.Bind(&requestBody)

		req := PostRequest{
			Title:  requestBody.Title,
			Post:   requestBody.Post,
			Price:  requestBody.Price,
			UserID: requestBody.UserID,
		}
		//Add item somewhere. Database etc.
		insert, err := db.Query("INSERT INTO requests(title,post,price,poster_id) VALUES ( '" + req.Title + "','" + req.Post + "'," + fmt.Sprintf("%g", req.Price) + ",'" + req.UserID + "')")
		if err != nil {
			panic(err.Error())
		}
		insert.Close()
		c.Status(http.StatusNoContent)
	}
}
