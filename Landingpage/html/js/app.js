
const searchBar = document.getElementById('searchBar');
let cardRecommended = [];
let cardUploaded = [];

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

const displayRecommended = (Cards) => {
    const htmlString = Cards
        .map((Card) => {
            return `
            <ul class="cardListRecommended">
                <h2>${Card.onderwerp}</h2>
                <p> ${Card.wat}</p>
                <h1> ${Card.niveau}</h1>
                <img src="css/hu_logo.png" width= "75px"</img>
                <button id="modalBtn">Lees meer</button>
            </ul>
        `;
        })
        .join('');
        cardListRecommended.innerHTML = htmlString;
        cardListUploaded.innerHTML = htmlString;
};
loadCharacters();


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("modalBtn");
    
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }