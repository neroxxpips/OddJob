package request

type Request struct {
	RequestID  int     `json:"rid"`
	Title      string  `json:"title"`
	Post       string  `json:"post"`
	Price      float32 `json:"price"`
	UserID     string  `json:"userid"`
	AcceptorID string  `json:"acceptid"`
}

func New(rid int, title string, post string, price float32, uid string, aid string) *Request {
	return &Request{
		RequestID:  rid,
		Title:      title,
		Post:       post,
		Price:      price,
		UserID:     uid,
		AcceptorID: aid,
	}
}
