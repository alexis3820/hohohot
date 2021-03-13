var socket = new WebSocket('wss://ws.hothothot.dog:9502');
socket.onopen = function(event) {
    console.log("Connecté à hothothot.dog");
    // Display user friendly messages for the successful establishment of connection
    var label = document.getElementById("status");
    label.innerHTML = "Connecté à hothothot.dog";
    socket.send('');
}

socket.onmessage = function(event) {
    var tempInt = document.getElementById("tempInt");
    var tempExt = document.getElementById("tempExt");
    var alertInt = document.getElementById("alertInt");
    var alertExt = document.getElementById("alertExt");
    let temperatures = JSON.parse(event.data);

    $.ajax({
        url: '/capteur/insert',
        type: 'POST',
        // contentType: 'application/json; charset=utf-8',
        data: {temperature: JSON.stringify(temperatures.capteurs)},
        // data: capteurs,
        dataType: 'text',

        error: function (resultat, statut, erreur) {
            console.log(erreur);
            console.log(resultat);
            console.log(statut);
        },

        success: function (data, status, xhr) {// success callback function
            console.log(data);
            let finalData = JSON.parse(data);
            tempInt.innerHTML = JSON.stringify(finalData.value_int);
            tempExt.innerHTML = JSON.stringify(finalData.value_ext);
            alertInt.innerHTML = JSON.stringify(finalData.alert_int);
            alertExt.innerHTML = JSON.stringify(finalData.alert_ext);
        }

    });
}

function showAlert() {
    var alertExt = document.getElementById("alertExt");
    var alertInt = document.getElementById("alertInt");
    if (alertExt.style.display === "none" || alertInt.style.display === "none") {
        alertExt.style.display = "block";
        alertInt.style.display = "block";
    } else {
        alertInt.style.display = "none";
        alertExt.style.display = "none";
    }
}