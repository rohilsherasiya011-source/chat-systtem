let currentUser = null;

function startChat(id, name){
    currentUser = id;
    document.getElementById("chat_with").innerText = "Chat with " + name;
    loadMessages();
}

function loadMessages(){
    if(!currentUser) return;

    let form = new FormData();
    form.append("sender_id", LOGGED_IN_USER);
    form.append("receiver_id", currentUser);

    fetch("chat.php", { method: "POST", body: form })
    .then(res => res.text())
    .then(data => {
        document.getElementById("messages").innerHTML = data;
    });
}

document.getElementById("sendBtn").onclick = function(){
    let msg = document.getElementById("message").value;
    if(msg.trim() === "" || !currentUser) return;

    let form = new FormData();
    form.append("sender_id", LOGGED_IN_USER);
    form.append("receiver_id", currentUser);
    form.append("message", msg);

    fetch("chat.php", { method: "POST", body: form })
    .then(() => {
        document.getElementById("message").value = "";
        loadMessages();
    });
};

setInterval(loadMessages, 1000);
