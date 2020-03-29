package user

type User struct {
	ID              string  `json:"id"`
	Password        string  `json:"password"`
	FirstName       string  `json:"fname"`
	LastName        string  `json:"lname"`
	Email           string  `json:"email"`
	State           string  `json:"state"`
	City            string  `json:"city"`
	Zipcode         int     `json:"zip"`
	PhoneNumber     string  `json:"phonenum"`
	Rating          float64 `json:"rating"`
	BackgroundCheck bool    `json:"backgroundcheck"`
}

func New(id string, password string, fname string, lname string, email string, state string, city string, zip int, phonenum string, rating float64, bg_check bool) *User {
	return &User{
		ID:              id,
		Password:        password,
		FirstName:       fname,
		LastName:        lname,
		Email:           email,
		State:           state,
		City:            city,
		Zipcode:         zip,
		PhoneNumber:     phonenum,
		Rating:          rating,
		BackgroundCheck: bg_check,
	}
}
