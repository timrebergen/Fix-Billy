const cardList = document.getElementById('cardList');
const searchBar = document.getElementById('searchBar');
let cardRecommended = [];

searchBar.addEventListener('keyup', (e) => {
    const searchString = e.target.value;
    const filteredCards = cardRecommended.filter(cardRecommended => {
        return (
            cardRecommended.onderwerp.includes(searchString) ||
            cardRecommended.wat.includes(searchString)
        );
    });
    console.log(filteredCards)
    displayRecommended(filteredCards);
});

const loadCharacters = async () => {
    try {
        const res = await fetch('https://run.mocky.io/v3/768e04e4-d6bb-4336-b3ea-f17dbb0d2b40');
        cardRecommended = await res.json();
        displayRecommended(cardRecommended);
    } catch (err) {
        console.error(err);
    }
};

const displayRecommended = (Recommended) => {
    const htmlString = Recommended
        .map((Card) => {
            return `
            <ul class="cardListRecommended">
                <h2>${Card.onderwerp}</h2>
                <p> ${Card.wat}</p>
                <h1> ${Card.niveau}</h1>
                <button>Lees meer</button>
                <img src= "" width= "60px"</img>
            </ul>
        `;
        })
        .join('');
        cardListRecommended.innerHTML = htmlString;
};
loadCharacters();
