package handler

import (
	"database/sql"
	"net/http"

	"github.com/gin-gonic/gin"
)

func DeleteReq(db *sql.DB) gin.HandlerFunc {
	return func(c *gin.Context) {

		requestid := c.DefaultQuery("requestID", "0")

		queryDel := "DELETE FROM requests WHERE request_id =" + requestid
		del, err := db.Query(queryDel)

		if err != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}
		del.Close()

		c.Status(http.StatusNoContent)
	}
}
