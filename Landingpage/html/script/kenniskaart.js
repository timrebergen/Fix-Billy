window.onload = function () {
    fetch('http://billy.hu-open-ict.nl/api-pg/product/read.php')
        .then(response => response.json())
        .then(cardData => {
            let onderwerp = 'ascending';
            let niveau = 'ascending';
            let wat = 'ascending';
            appendData(cardData);

            function appendData(RecommendedData) {
                let mainContainer = document.getElementById("vulling");
                for (let i = 0; i < RecommendedData.length; i++) {
                    let h1 = document.createElement("h1");
                    h1.innerHTML = '';
                    mainContainer.appendChild(tr);
                    let trNaam = document.createElement("td");
                    trNaam.innerHTML = RecommendedData[i].toets_naam;
                    mainContainer.appendChild(trNaam);
                    let trToets = document.createElement("td");
                    trToets.innerHTML = RecommendedData[i].toets_code;
                    mainContainer.appendChild(trToets);
                    let trJaar = document.createElement("td");
                    trJaar.innerHTML = RecommendedData[i].jaar;
                    mainContainer.appendChild(trJaar);
                    let trBlok = document.createElement("td");
                    trBlok.innerHTML = RecommendedData[i].blok;
                    mainContainer.appendChild(trBlok);
                }

                document.getElementById("toetsnaam").onclick = function () {
                    const gevuldeTabel = document.getElementById('vulling');
                    gevuldeTabel.innerHTML = '';
                    sorterenToetsnaam()
                    if (sortToetsnaam === 'ascending') {
                        sortToetsnaam = 'descending';
                    } else {
                        sortToetsnaam = 'ascending';
                    }
                };

                document.getElementById("blok").onclick = function () {
                    const gevuldeTabel = document.getElementById('vulling');
                    gevuldeTabel.innerHTML = '';
                    sorterenBlok()
                    if (sortBlok === 'ascending') {
                        sortBlok = 'descending';
                    } else {
                        sortBlok = 'ascending';
                    }
                };

                document.getElementById("toetscode").onclick = function () {
                    const gevuldeTabel = document.getElementById('vulling');
                    gevuldeTabel.innerHTML = '';
                    sorterenToetscode()
                    if (sortToetscode === 'ascending') {
                        sortToetscode = 'descending';
                    } else {
                        sortToetscode = 'ascending';
                    }
                };

                document.getElementById("jaar").onclick = function () {
                    const gevuldeTabel = document.getElementById('vulling');
                    gevuldeTabel.innerHTML = '';
                    sorterenJaar()
                    if (sortJaar === 'ascending') {
                        sortJaar = 'descending';
                    } else {
                        sortJaar = 'ascending';
                    }
                };

            }

            function sorterenToetsnaam() {
                const sortedToetsnaam = data.sort((a, b) => {
                    if (a.toets_naam < b.toets_naam) {
                        return sortToetsnaam === 'ascending' ? -1 : 1
                    } else if (a.toets_naam > b.toets_naam) {
                        return sortToetsnaam === 'ascending' ? 1 : -1
                    } else {
                        return 0
                    }

                })

                appendData(sortedToetsnaam)
            }

            function sorterenBlok() {
                const sortedBlok = data.sort((a, b) => {
                    if (a.blok < b.blok) {
                        return sortBlok === 'ascending' ? -1 : 1
                    } else if (a.blok > b.blok) {
                        return sortBlok === 'ascending' ? 1 : -1
                    } else {
                        return 0
                    }

                })

                appendData(sortedBlok)
            }

            function sorterenToetscode() {
                const sortedToetscode = data.sort((a, b) => {
                    if (a.toets_code < b.toets_code) {
                        return sortToetscode === 'ascending' ? -1 : 1
                    } else if (a.toets_code > b.toets_code) {
                        return sortToetscode === 'ascending' ? 1 : -1
                    } else {
                        return 0
                    }

                })

                appendData(sortedToetscode)
            }

            function sorterenJaar() {
                const sortedJaar = data.sort((a, b) => {
                    if (a.jaar > b.jaar) {
                        return sortJaar === 'ascending' ? -1 : 1
                    } else if (a.jaar < b.jaar) {
                        return sortJaar === 'ascending' ? 1 : -1
                    } else {
                        return 0
                    }

                })

                appendData(sortedJaar)
            }

        })
        .catch((err) => console.log(err));
};

