window.addEventListener('load', function () {

    // store tabs variables
    const tabs = document.querySelectorAll('div.nav-tabs > ul > li');

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
})
