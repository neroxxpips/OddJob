package main

import(
	"log"
	"net/http"
	"github.com/gorilla/websocket"
)

/* == GO Chat System Prototype ==

	This is a test system for the chat program proposed
	for the OddJob application.

	==> Original Code: https://scotch.io/bar-talk/build-a-realtime-chat-server-with-go-and-websockets

	Nate Heppard
	3 April 2020
*/

// === Globals =============================
var clients = make(map[*websocket.Conn]bool) // connected clients
var broadcast = make(chan Message)			 // broadcast channel

var upgrader = websocket.Upgrader{} 		 // configure the upgrader
// =========================================

type Message struct{
	Email string `json:"email"`
	Username string `json:"username"`
	Message string `json:"message"`
}

/*
	Main function
*/
func main(){
	// create simple file server
	fs := http.FileServer(http.Dir("../public"))
	http.Handle("/", fs)

	// configure websocket route
	http.HandleFunc("/ws", handleConnections) // define handleConnections later

	// start listening for incoming chat messages
	go handleMessages()

	// start server on localhost port 8000 and log errors
	log.Println("http server started on port :8000")
	err := http.ListenAndServe(":8000", nil)

	if err != nil{
		log.Fatal("ListenAndServe: ", err)
	}
}

/*
	Handles incoming WebSocket connections
*/
func handleConnections(w http.ResponseWriter, r *http.Request){
	// upgrade initial GET request to a websocket
	ws, err := upgrader.Upgrade(w, r, nil)

	if err != nil{
		log.Fatal(err)
	}

	// make sure to close the connection when function returns
	defer ws.Close()

	// register new client
	clients[ws] = true

	// infinite loop to wait for new messages
	for{
		var msg Message

		// read in a new message as a JSON and map it to a Message object
		err := ws.ReadJSON(&msg)

		// if error occurs: assume client has disconnected, remove, and end 
		if err != nil{
			log.Println("@ handleConnections()");
			log.Printf("error: %v", err)
			delete(clients, ws)
			break
		}

		// send newly received message to the broadcast channel
		broadcast <- msg
	}
}

/*
	Continuously reads from broadcast channel and relays message to all clients
	over their respective WebSocket connection
*/
func handleMessages(){
	for{
		// get next message from broadcast channel
		msg := <- broadcast

		// send message to each currently connected client
		for client := range clients{
			err := client.WriteJSON(msg)

			if err != nil{
				log.Println("@ handleMessages()");
				log.Printf("error: %v", err)
				client.Close()
				delete(clients, client)
			}
		}
	}
}