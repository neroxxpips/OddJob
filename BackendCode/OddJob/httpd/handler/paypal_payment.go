package handler

import (
	"OddJob/platform/request"
	"OddJob/platform/user"
	"database/sql"
	"net/http"
	"strconv"

	"github.com/gin-gonic/gin"

	"log"
	"os"

	paypal "github.com/netlify/PayPal-Go-SDK"
)

type PaymentRequest struct {
	RequestID int    `json:"requestid"`
	CCNum     string `json:"card_num"`
	CCType    string `json:"card_type"`
	CCExpMon  string `json:"card_month"`
	CCExpYear string `json:"card_year"`
	CVV       string `json:"card_cvv"`
}

func PayPalPayment(db *sql.DB) gin.HandlerFunc {
	return func(ctx *gin.Context) {
		requestBody := PaymentRequest{}
		ctx.Bind(&requestBody)

		paymentInfo := PaymentRequest{
			RequestID: requestBody.RequestID,
			CCNum:     requestBody.CCNum,
			CCType:    requestBody.CCType,
			CCExpMon:  requestBody.CCExpMon,
			CCExpYear: requestBody.CCExpYear,
			CVV:       requestBody.CVV,
		}

		var request request.Request
		query := "SELECT * FROM requests WHERE request_id=?"

		err := db.QueryRow(query, paymentInfo.RequestID).Scan(&request.RequestID, &request.Title, &request.Post, &request.Price, &request.Number, &request.Street, &request.State, &request.City, &request.Zipcode, &request.Task, &request.Latitude, &request.Longitude, &request.Image, &request.UserID, &request.AcceptorID)

		if err != nil {
			panic(err)
		}
		var user user.User
		query2 := "SELECT user_id,firstname,lastname,email,state,city,phonenumber,userimg,rating,backgroundcheck FROM userprofiles WHERE user_id=?"

		err2 := db.QueryRow(query2, request.AcceptorID).Scan(&user.Username, &user.FirstName, &user.LastName, &user.Email, &user.State, &user.City, &user.PhoneNumber, &user.Image, &user.Rating, &user.BackgroundCheck)
		if err2 != nil {
			panic(err.Error()) // proper error handling instead of panic in your app
		}

		c := MakeClient("AXhnDVIyv3mDrNBqzWicwxR8jrl9MR-MSYljv1wZnRFZb7fnJefkt61oIUkpX5x0I0IPA2pKpIIjcjOr",
			"EKySL_mKLW3FnMZZp1TAB3inaCY4xdHRmEk_eZpTejw_25pidrMEdQ1uLeQg9ef4G_xCDY9B2lVXmwlA")

		WholeTransaction(c, user.Email, request.Price, paymentInfo.CCNum, paymentInfo.CCType, paymentInfo.CCExpMon, paymentInfo.CCExpYear, paymentInfo.CVV, user.FirstName, user.LastName)

		ctx.Status(http.StatusNoContent)
	}
}

func MakeClient(clientID string, secretID string) paypal.Client {
	c, err := paypal.NewClient(
		clientID,
		secretID,
		paypal.APIBaseSandBox)

	c.SetLog(os.Stdout)
	if err != nil {
		log.Fatal("Error found")
	}

	_, err = c.GetAccessToken()
	if err != nil {
		panic(err)
	}

	return *c
}

func AddPayInfo(number string, cType string, expMonth string, expYear string, cvv2 string, fname string, lname string, total string) paypal.Payment {
	p := paypal.Payment{
		Intent: "sale",
		Payer: &paypal.Payer{
			PaymentMethod: "credit_card",
			FundingInstruments: []paypal.FundingInstrument{{
				CreditCard: &paypal.CreditCard{
					Number:      number,
					Type:        cType,
					ExpireMonth: expMonth,
					ExpireYear:  expYear,
					CVV2:        cvv2,
					FirstName:   fname,
					LastName:    lname,
				},
			}},
		},

		Transactions: []paypal.Transaction{{
			Amount: &paypal.Amount{
				Currency: "USD",
				Total:    total,
			},
			Description: "My payment",
		}},

		RedirectURLs: &paypal.RedirectURLs{
			ReturnURL: "return",
			CancelURL: "cancel",
		},
	}

	return p
}

func EmailPayout(email string, amount string) paypal.Payout {
	payout := paypal.Payout{
		SenderBatchHeader: &paypal.SenderBatchHeader{
			EmailSubject: "Thank you for your work!",
		},
		Items: []paypal.PayoutItem{
			{
				RecipientType: "EMAIL",
				Receiver:      email,
				Amount: &paypal.AmountPayout{
					Value:    amount,
					Currency: "USD",
				},
				Note:         "",
				SenderItemID: "",
			},
		},
	}

	return payout

}

func WholeTransaction(c paypal.Client, email string, amount float32, cardNum string, cardType string, cardMon string, cardYear string, cardCVV string, fName string, lName string) {

	amountStr := strconv.FormatFloat(float64(amount), 'f', 2, 64)
	p := AddPayInfo(cardNum, cardType, cardMon, cardYear, cardCVV, fName, lName, amountStr)
	c.CreatePayment(p)
	newAmount := 0.05 * amount
	amount = amount - newAmount
	amountStr = strconv.FormatFloat(float64(amount), 'f', 2, 64)
	po := EmailPayout(email, amountStr)

	c.CreateSinglePayout(po)

}
