window.addEventListener('load', function () {

    // store tabs variables
    const tabs = document.querySelectorAll('div.nav-tabs > li');

    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener('click', switchTab);
    }

    function switchTab(event) {
        event.preventDefault();

        document.querySelector('div.nav-tabs li.active').classList.remove('active');
        document.querySelector('div.tab-pane.active').classList.remove('active');

        const clickedTab = event.currentTarget;
        const anchor = event.target;
        const activePaneID = anchor.getAttribute('href');

        clickedTab.classList.add('active');
        document.querySelector(activePaneID).classList.add('active')
    }


    const table = document.getElementById('table-body');

    /* Per mostrare i dati 'real-time' */
    function showData() {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/../wp-content/plugins/library-plugin-prova/admin/php/getData.php', true);
        xhr.setRequestHeader('Content-Type', 'Application/json');
        // xhr.responseType = 'json';
        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log(xhr.response);
            } else {
                console.log('Server error');
            }
        }
        xhr.send();
    }

    showData();


    /* Per modificare i dati nella tabella 'wp_prenotazione' nel db*/
    const deleteButton = document.querySelector('#delete9');
    // deleteButton.forEach(item => {
    //     console.log(item)
    // })
    deleteButton.addEventListener('click', deleteReservation);

    function deleteReservation(event) {
        event.preventDefault();
        const prg = document.createElement('p');
        prg.innerHTML = 'Prenotazione eliminata correttamente'
        const table = document.querySelector('div#tab-1')
        table.insertBefore(prg, table.children[0]);
        // console.log(event.target.value) //'Elimina'

        const id = document.querySelector('input#id_prenotazione').value

        console.log(id)
        console.log(deleteButton)


        /* Creo oggetto XMLHttpRequest */
        const xhr = new XMLHttpRequest()
        xhr.open('POST', '/../wp-content/plugins/library-plugin-prova/admin/php/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'Application/json');
        const params = JSON.stringify({
            name: 'Dalia'
        })
        xhr.onload = function () {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText)
                // console.log(id)
                console.log(response)

                // console.log(xhr.response)
            } else {
                console.log('Server error')
            }
        }
        xhr.send(params);
    }

})
