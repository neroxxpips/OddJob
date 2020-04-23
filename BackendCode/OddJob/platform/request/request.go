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
	UserID     string  `json:"userid"`
	AcceptorID string  `json:"acceptid"`
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
	UserID    string  `json:"userid"`
}

type SmallRequest struct {
	RequestID int     `json:"rid"`
	Title     string  `json:"title"`
	Post      string  `json:"post"`
	Price     float32 `json:"price"`
	State     string  `json:"state"`
	City      string  `json:"city"`
	Task      string  `json:"task"`
	UserID    string  `json:"userid"`
}

type LocationRequest struct {
	RequestID int    `json:"rid"`
	Number    int    `json:"number"`
	Street    string `json:"address"`
	State     string `json:"state"`
	City      string `json:"city"`
}

func New(rid int, title string, post string, price float32, number int, street string, state string, city string, zip int, task string, uid string, aid string) *Request {
	return &Request{
		RequestID:  rid,
		Title:      title,
		Post:       post,
		Price:      price,
		Number:     number,
		Street:     street,
		State:      state,
		City:       city,
		Zipcode:    zip,
		Task:       task,
		UserID:     uid,
		AcceptorID: aid,
	}
}

func NoAcceptedNew(rid int, title string, post string, price float32, number int, street string, state string, city string, zip int, task string, uid string) *RequestNoAccepted {
	return &RequestNoAccepted{
		RequestID: rid,
		Title:     title,
		Post:      post,
		Price:     price,
		Number:    number,
		Street:    street,
		State:     state,
		City:      city,
		Zipcode:   zip,
		Task:      task,
		UserID:    uid,
	}
}
