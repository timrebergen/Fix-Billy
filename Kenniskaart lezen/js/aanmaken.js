

function post_student() {
    let selOnderwerp = document.getElementById('onderwerp').value;
    let selWhy = document.getElementById('wat').value;

    let data = {
        'onderwerp': selOnderwerp,
        'wat': selWhy,
    };
    fetch('http://billy.hu-open-ict.nl/api-pg/product/read.php/', {
        method: 'get',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            const contentType = response.headers.get("content-type");
            if (contentType && contentType.indexOf('application/json') !== -1)
                return response.json();
            else {
                console.log("nonJson received");
                console.log(response.text());
                return null;
            }
        })
        .then(data => {
            console.log('Success:', data);
            alert('Kenniskaart opgeslagen');
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Er is iets fout gegaan. Probeer het opnieuw')
        });
    let form = document.getElementById("myForm");
}
