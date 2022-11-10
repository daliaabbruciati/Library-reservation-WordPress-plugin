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
                // console.log(xhr.response);
            } else {
                console.log('Server error');
            }
        }
        xhr.send();
    }




    /* Per modificare i dati nella tabella 'wp_prenotazione' nel db*/
    const deleteButton = document.getElementById('delete');
    const data_id = deleteButton.dataset.id;
    deleteButton.addEventListener('click', deleteReservation);

    async function deleteReservation(event) {
        event.preventDefault();
        const prg = document.createElement('p');
        const table = document.querySelector('div#tab-1')

        console.log(data_id)

        // const url = '/../wp-content/plugins/library-plugin-prova/admin/php/delete.php';

        const url = window.location.href;








        //     fetch(url, {
        //         method: "POST",
        //         headers: {"Content-type": "application/x-www-form-urlencoded; charset=UTF-8"},
        //     })
        //         .then(function (response){
        //             // tolgo il caricamento
        //             //elimino riga
        //             // JSON.stringify(response)
        //             prg.innerHTML = 'Prenotazione eliminata correttamente'
        //             table.insertBefore(prg, table.children[0]);
        //             // console.log(response.body)
        //             console.log(response)
        //
        //         })
        //         .catch(function (error){
        //             // tolgo il caricamento
        //             console.log(error)
        //         })

        await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: JSON.stringify({
                id: data_id,
                delete: '1'
            })
        })
            .then((response) => response.json())
            .then((data) => {
                prg.innerHTML = 'Prenotazione eliminata correttamente'
                table.insertBefore(prg, table.children[0]);
                showData();
                console.log('Successooo', data)
            })
            .catch((error) => {
                console.error('Error', error)
            });
    }



    /* Creo oggetto XMLHttpRequest */
    //     const xhr = new XMLHttpRequest()
    //     xhr.setRequestHeader('Content-Type', 'Application/json');
    //     xhr.open('POST', '/../wp-content/plugins/library-plugin-prova/admin/php/delete.php', true);
    //     const params = JSON.stringify({
    //         name: 'Dalia'
    //     })
    //     xhr.send(params);

    //     xhr.onload = function () {
    //         if (xhr.status === 200) {
    //             let response = JSON.parse(xhr.responseText)
    //             // console.log(id)
    //             console.log(response)
    //
    //             // console.log(xhr.response)
    //         } else {
    //             console.log('Server error')
    //         }
    //     }
    // }

})
