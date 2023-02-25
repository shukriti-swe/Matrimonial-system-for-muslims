/**
 * Created by Farhad Zaman on 3/3/2017.
 */

   // var socket=io.connect("ws://52.15.120.187:8080");
var socket=io.connect("ws://"+location.hostname+":8080");


    var token=String(localStorage.getItem("_r"));
    var tokenData={
        _r:token,
        url:baseUrl //located in views/layout/header_script.php line 27-29
    };

    socket.emit("register",JSON.stringify(tokenData));
    //socket.emit("messageNotification",JSON.stringify(data));



