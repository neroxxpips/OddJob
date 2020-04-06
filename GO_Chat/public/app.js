/**
    app.js

    Implements VueJS
*/

// create Vue object
new Vue({
    el: '#app',

    data:{
        ws: null,       // the websocket
        newMsg: '',     // holds new messages to be sent to server
        chatContent: '', // running list of chat messages displayed on screen
        email: null,    // email address used for grabbing avatar
        username: null, // the username
        joined: false   // True if email and username have been filled in
    },

    created: function(){
        var self = this;
        this.ws = new WebSocket('ws://' + window.location.host + '/ws');
        this.ws.addEventListener('message', function(e){
            var msg = JSON.parse(e.data);
            self.chatContent += '<div class="chip">'
                + '<img src="' + self.gravatarURL(msg.email) + '">' // the avatar
                + msg.username
                + '</div>'
                + emojione.toImage(msg.message) + '<br/>'; // parse emojis
            var element = document.getElementById('chat-messages');
            element.scrollTop = element.scrollHeight; // auto scroll to bottom
        });
    },

    methods:{
        send: function(){
            if(this.newMsg != ''){
                this.ws.send(
                    JSON.stringify({
                        email: this.email,
                        username: this.username,
                        message: $('<p>').html(this.newMsg).text() // strip out html
                    }
                ));
                this.newMsg = ''; // reset newMsg
            }
        },

        join: function(){
            if(!this.email){
                Materialize.toast('You must enter an email', 2000);
                return
            }

            if(!this.username){
                Materialize.toast('You must choose a username', 2000);
                return
            }

            this.email = $('<p>').html(this.email).text();
            this.username = $('<p>').html(this.username).text();
            this.joined = true;
        },

        gravatarURL: function(email){
            return 'http://www.gravatar.com/avatar/' + CryptoJS.MD5(email);
        }
    }
});