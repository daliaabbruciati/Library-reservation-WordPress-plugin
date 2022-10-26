window.addEventListener('load', function () {

    // document.querySelector('#nome_utente').addEventListener('input', function (event) {
    // //     const stanza = document.querySelector('#stanza').value;
    // //     console.log(stanza);
    //
    //     // const name = document.querySelector('#nome_utente');
    //     console.log(event.target.value)
    // //
    // })

    /* Nel backend */
    document.querySelector('#nome_utente').addEventListener('input', getInput);

    function getInput(event){
        const prg = document.createElement('p');
        prg.innerHTML = 'Ciao mondo sono un paragrafo'
        const form = document.querySelector('.form--error')
        form.appendChild(prg);
        console.log(event.target.value)
        console.log(prg)
    }

    /* Nel frontend */
    const stanza = document.querySelector('#nome_stanza')
    stanza.addEventListener('change',handleChange)

    function handleChange(event){
        console.log(event.target.value)
    }
})
