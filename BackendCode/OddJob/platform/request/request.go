package request

type Request struct {
	RequestID  int     `json:"rid"`
	Title      string  `json:"title"`
	Post       string  `json:"post"`
	Price      float32 `json:"price"`
	Number     int     `json:"number"`
	Street     string  `json:"address"`
	State      string  `json:"state"`
	City       string  `json:"city"`
	Zipcode    int     `json:"zip"`
	Task       string  `json:"task"`
	Latitude   float64
	Longitude  float64
	Image      string `json:"image"`
	UserID     string `json:"userid"`
	AcceptorID string `json:"acceptid"`
}

type RequestNoAccepted struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	Number    int     `json:"number"`
	Street    string  `json:"address"`
	State     string  `json:"state"`
	City      string  `json:"city"`
	Zipcode   int     `json:"zip"`
	Task      string  `json:"task"`
	Latitude  float64
	Longitude float64
	Image     string `json:"image"`
	UserID    string `json:"userid"`
}

type SmallRequest struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	State     string  `json:"state"`
	City      string  `json:"city"`
	Task      string  `json:"task"`
	Latitude  float64
	Longitude float64
	Image     string `json:"image"`
	UserID    string `json:"userid"`
}

type LocationRequest struct {
	RequestID int `json:"rid"`
	Latitude  float64
	Longitude float64
}
