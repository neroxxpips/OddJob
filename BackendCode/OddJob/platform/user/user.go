package user

type User struct {
	Username        string  `json:"username"`
	FirstName       string  `json:"fname"`
	LastName        string  `json:"lname"`
	Email           string  `json:"email"`
	State           string  `json:"state"`
	City            string  `json:"city"`
	PhoneNumber     string  `json:"phonenum"`
	Image           string  `json:"image"`
	Rating          float64 `json:"rating"`
	BackgroundCheck bool    `json:"backgroundcheck"`
}
