const url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + 'var da mettere' + '&size=130x130&margin=10';

fetch(url)
    .then(function (response) {
        return response.url;
    })
    .then(function (body) {
        document.getElementById('qrcode').innerHTML = body
        // console.log(body)
    });
