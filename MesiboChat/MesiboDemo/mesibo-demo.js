/* Refer following tutorial and API documentation to know how to create a user token
 * https://mesibo.com/documentation/tutorials/first-app/ 
 */
var demo_user_token = ''; // token for user 18005550001: a49d40492859217786b55746c543c3064b0ca854b3b5b94e9912eb19
/* App ID used to create a user token. */
var MESIBO_APP_ID = '7712';
/* A destination where this demo app will send message or make calls */
var demo_destination = '18005550002';
// Mesibo App Token
var MESIBO_ACCESS_TOKEN = "pffiu38obyi7sie5t7r67v0392vxetscww5gkxk01pp6khs0vdud42t6ehnss6ba";

function DemoNotify(o) {
	this.api = o;
}

DemoNotify.prototype.Mesibo_OnConnectionStatus = function(status, value) {
	console.log("Mesibo_OnConnectionStatus: "  + status);
	var s = document.getElementById("cstatus");
	if(!s) return;
	if(MESIBO_STATUS_ONLINE == status) {
		s.classList.replace("btn-danger", "btn-success");
        s.innerText = "You are online";
        document.getElementById("username").innerHTML = "User: " + demo_user_token;
        document.getElementById("recipient").innerHTML = "Sending to: " + demo_destination;
		return;
	} 
		
	s.classList.replace("btn-success", "btn-danger");
	switch(status) {
		case MESIBO_STATUS_CONNECTING:
			s.innerText = "Connecting";
			break;

		case MESIBO_STATUS_CONNECTFAILURE:
			s.innerText = "Connection Failed";
			break;

		case MESIBO_STATUS_SIGNOUT:
			s.innerText = "Signed out";
			break;

		case MESIBO_STATUS_AUTHFAIL:
			s.innerText = "Disconnected: Bad Token or App ID";
			break;

		default:
			s.innerText = "You are offline";
			break;
	}
}

DemoNotify.prototype.Mesibo_OnMessageStatus = function(m) {
	console.log("Mesibo_OnMessageStatus: from "  + m.peer + " status: " + m.status + " id: " + m.id);
}

DemoNotify.prototype.Mesibo_OnMessage = function(m, data) {
	var s = array2String(data, 0, data.byteLength);
	console.log("Mesibo_OnMessage: from "  + m.peer + " id: " + m.id + " msg: " + s);
    console.log(data);
    
    document.getElementById("messageHistory").value = data;
}

DemoNotify.prototype.Mesibo_OnCall = function(callid, from, video) {
	console.log("Mesibo_onCall: " + (video?"Video":"Voice") + " call from: " + from);
	if(video)
		this.api.setupVideoCall("localVideo", "remoteVideo", true);
	else
		this.api.setupVoiceCall("audioPlayer");

	var s = document.getElementById("ansBody");
	if(s)
		s.innerText = "Incoming " + (video?"Video":"Voice") + " call from: " + from;

	$('#answerModal').modal({ show: true });
}

DemoNotify.prototype.Mesibo_OnCallStatus = function(callid, status) {
	console.log("Mesibo_onCallStatus: " + status);
	var v = document.getElementById("vcstatus");
	var a = document.getElementById("acstatus");

	var s = "Complete"; 
	if(status&MESIBO_CALLSTATUS_COMPLETE) {
		console.log("closing");
		$('#answerModal').modal("hide");
	}

	switch(status) {
		case MESIBO_CALLSTATUS_RINGING:
			s = "Ringing";
			break;

		case MESIBO_CALLSTATUS_ANSWER:
			s = "Answered";
			break;

		case MESIBO_CALLSTATUS_BUSY:
			s = "Busy";
			break;

		case MESIBO_CALLSTATUS_NOANSWER:
			s = "No Answer";
			break;

		case MESIBO_CALLSTATUS_INVALIDDEST:
			s = "Invalid Destination";
			break;

		case MESIBO_CALLSTATUS_UNREACHABLE:
			s = "Unreachable";
			break;

		case MESIBO_CALLSTATUS_OFFLINE:
			s = "Offline";
			break;
	}

	v.innerText = "Call Status: " + s;
	a.innerText = "Call Status: " + s;
}

var api = new Mesibo();
api.setAppName(MESIBO_APP_ID);
api.setListener(new DemoNotify(api));
api.setCredentials(demo_user_token);
api.start();

var message_index = 0;
function sendMessage(msg) {
	var p = {};
	p.peer = demo_destination;	
	p.type = 0;
	p.expiry = 3600*24;
	p.flag = MESIBO_FLAG_DELIVERYRECEIPT|MESIBO_FLAG_READRECEIPT;
	//api.sendMessage(p, 678, "Hello From JavaScript");
    //api.sendMessage(p, api.random(), message_index + ": ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
    api.sendMessage(p, api.random(), message_index + ":" + msg);
	message_index++;

}

function sendFile() {
	var p = {};
	p.peer = demo_destination;	
	p.type = 0;
	p.expiry = 3600*24;
	p.flag = MESIBO_FLAG_DELIVERYRECEIPT|MESIBO_FLAG_READRECEIPT;
	
	var msg = {}; //create a rich message
	msg.type = 1;	// 2 for video, 3 audio, 10 other
	msg.size = 1023;	
	msg.url = 'https://cdn.pixabay.com/photo/2019/08/02/09/39/mugunghwa-4379251_1280.jpg'
	msg.title = 'Himalaya';
	msg.message = 'Hello from js';
	api.sendFile(p, api.random(), msg);
}

function sendReadReceipt() {
	var p = {};
	p.peer = demo_destination;	
	p.type = 0;
	p.expiry = 3600*24;

	var rrid = 13453967264; //id of the message for which we are sending read-receipt 
	api.sendReadReceipt(p, rrid);
}

function getInput(){
    var input = document.getElementById("message").value;
    sendMessage(input);
}

function setUserToken(){
    var element = document.getElementById("userToken");
    var token = element.value;
    demo_user_token = token;
    element.value = "";
    api.setCredentials(demo_user_token);
    api.start();
}

function httpGet(){
    var element = document.getElementById("newUser");
    var userID = element.value;
    var xmlHttp = new XMLHttpRequest();
    var url = "https://api.mesibo.com/api.php?token="+MESIBO_ACCESS_TOKEN+"&op=useradd&appid="+MESIBO_APP_ID+"&addr="+userID;
    xmlHttp.open( "GET", url, false ); // false for synchronous request
    xmlHttp.send( null );
    element.value = "";
    return xmlHttp.responseText;
}
