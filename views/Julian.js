function createSelectElement() {
    const select = document.createElement('select');
    select.classList.add('select');
    const subjects = [
        '---------------------', 'Action', 'Fiction', 'Horror', 'Romance', 'Science Fiction', 'Mystery',
        'Thriller', 'Fantasy', 'Adventure', 'Biography', 'History', 'Science', 'Religion', 'Travel',
        'Cooking', 'Health', 'Fitness', 'Sports', 'Education', 'Music', 'Art', 'Photography',
        'Computers', 'Programming', 'Business', 'Economics', 'Finance', 'Marketing', 'Management',
        'Psychology', 'Self-Help', 'Family', 'Relationships', 'Games', 'Comics', 'Graphic Novels',
        'Poetry', 'Drama', 'Humor', 'Children', 'Young Adult'
    ];
    subjects.forEach(subject => {
        const option = document.createElement('option');
        option.value = subject.toLowerCase().replace(' ', '');
        option.textContent = subject;
        select.appendChild(option);
    });
    return select;
}
const select = createSelectElement();

const btn = document.createElement('button'); btn.textContent = 'Search';

const favorisBtn = document.createElement('button'); favorisBtn.textContent = 'Favoris'; favorisBtn.classList.add('favlist');
const favorites = JSON.parse(localStorage.getItem('favorites')) || []; // Retrieve favorites from localStorage

const hr = document.createElement('hr');

const container = document.createElement('div'); container.classList.add('container');

// Organisation des éléments
body.appendChild(form);

form.appendChild(input)
form.appendChild(select)
form.appendChild(favorisBtn)
form.appendChild(btn)

body.appendChild(hr)
body.appendChild(container);

function search() {
    const maxResults = 20; // Nombre de résultats à afficher par page
    const startIndex = 0; // Début de l'index des résultats (0 pour le premier résultat de la page)
    const url = `https://www.googleapis.com/books/v1/volumes?q=${input.value}+subject:${select.value}&startIndex=${startIndex}&maxResults=${maxResults}&langRestrict=fr`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const title = input.value;
            const books = data.items;
            console.log(books);
            container.innerHTML = '';
            if (books) {
                books.forEach(book => {
                    const bookCard = document.createElement('div');
                    bookCard.classList.add('book-card');

                    // Titre raccourci a 15 caractères (pour tenir sur une ligne)
                    const maxChars = 15; // Nombre maximum de caractères à afficher
                    const titleText = book.volumeInfo.title;
                    const displayTitle = titleText.length > maxChars ? titleText.substring(0, maxChars) + '...' : titleText;

                    // Auteurs raccourcis a 15 caractères (pour tenir sur une ligne)
                    const maxLetter = 15; // Nombre maximum de caractères à afficher
                    let displayAuthors = '';

                    if (book.volumeInfo.authors) {
                        const authorsText = book.volumeInfo.authors.join(', '); // Joindre plusieurs auteurs en une seule chaîne
                        displayAuthors = authorsText.length > maxLetter ? authorsText.substring(0, maxLetter) + '...' : authorsText;
                    } else {
                        displayAuthors = 'Unknown';
                    }

                    // Vérifier si imageLinks et thumbnail sont disponibles, sinon utiliser une image par défaut
                    const thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : 'https://img.freepik.com/vecteurs-libre/pile-design-plat-dessine-main-illustration-livres_23-2149341898.jpg?size=338&ext=jpg&ga=GA1.1.1546980028.1711324800&semt=sph';

                    bookCard.innerHTML = `
                        <img src="${thumbnail}" alt="${thumbnail}">
                        <h2 title="${book.volumeInfo.title}">${displayTitle}</h2>
                        <p title="${book.volumeInfo.authors}">${displayAuthors}</p>
                        <p>${book.volumeInfo.publishedDate}</p>
                        <button><a href="${book.volumeInfo.previewLink}" target="_blank">Preview</a></button>
                        <button class="favoris" data-id="${book.id}">Favoris</button>
                    `;
                    const favoriButton = bookCard.querySelector('.favoris');
                    favoriButton.addEventListener('click', (e) => {
                        const id = e.target.getAttribute('data-id');
                        const isFavori = favoriButton.classList.toggle('isFavori');
                        favoriButton.textContent = isFavori ? 'Retirer des favoris' : 'Ajouter aux favoris';
                        if (isFavori) {
                            favorites.push(id);
                            favoriButton.style.backgroundColor = 'red';
                        } else {
                            const index = favorites.indexOf(id);
                            if (index > -1) {
                                favorites.splice(index, 1);
                            }
                            favoriButton.style.backgroundColor = '#efefef';
                        }
                        localStorage.setItem('favorites', JSON.stringify(favorites)); // Stocker les favoris dans le localStorage
                        console.log(isFavori ? 'Ajout du film aux favoris:' : 'Retrait du film des favoris:', book);
                    });
                    container.appendChild(bookCard);
                })
            } else {
                container.innerHTML = '<h2>No books found</h2>';
            }
        })
        .catch(err => {
            console.log(err);
            container.innerHTML = '<h2>Something went wrong</h2>';
        });
}

function showFavorites() {
    container.innerHTML = '';
    const url = `https://www.googleapis.com/books/v1/volumes/`;
    console.log(favorites);
    favorites.forEach(id => {
        fetch(url + id)
            .then(response => response.json())
            .then(data => {
                const book = data;
                console.log(book);
                const bookCard = document.createElement('div');
                bookCard.classList.add('book-card');

                // Titre raccourci a 15 caractères (pour tenir sur une ligne)
                const maxChars = 15; // Nombre maximum de caractères à afficher
                const titleText = book.volumeInfo.title;
                const displayTitle = titleText.length > maxChars ? titleText.substring(0, maxChars) + '...' : titleText;

                // Auteurs raccourcis a 15 caractères (pour tenir sur une ligne)
                const maxLetter = 15; // Nombre maximum de caractères à afficher
                let displayAuthors = '';

                if (book.volumeInfo.authors) {
                    const authorsText = book.volumeInfo.authors.join(', '); // Joindre plusieurs auteurs en une seule chaîne
                    displayAuthors = authorsText.length > maxLetter ? authorsText.substring(0, maxLetter) + '...' : authorsText;
                } else {
                    displayAuthors = 'Unknown';
                }

                // Vérifier si imageLinks et thumbnail sont disponibles, sinon utiliser une image par défaut
                const thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : 'https://img.freepik.com/vecteurs-libre/pile-design-plat-dessine-main-illustration-livres_23-2149341898.jpg?size=338&ext=jpg&ga=GA1.1.1546980028.1711324800&semt=sph';

                bookCard.innerHTML = `
                    <img src="${thumbnail}" alt="${thumbnail}">
                    <h2 title="${book.volumeInfo.title}">${displayTitle}</h2>
                    <p title="${book.volumeInfo.authors}">${displayAuthors}</p>
                    <p>${book.volumeInfo.publishedDate}</p>
                    <button><a href="${book.volumeInfo.previewLink}" target="_blank">Preview</a></button>
                    <button class="favoris" data-id="${book.id}">Favoris</button>
                `;

            const favoriButton = bookCard.querySelector('.favoris');

            if (favorites.includes(book.id)) {
                favoriButton.classList.add('isFavori');
                favoriButton.textContent = 'Retirer des favoris';
                favoriButton.style.backgroundColor = 'red';
            }

            favoriButton.addEventListener('click', (e) => {
                const id = e.target.getAttribute('data-id');
                const isFavori = favoriButton.classList.toggle('isFavori');

                if (isFavori) {
                    favorites.push(id);
                    favoriButton.textContent = 'Retirer des favoris';
                    favoriButton.style.backgroundColor = 'red';
                } else {
                    const index = favorites.indexOf(id);
                    if (index > -1) {
                        favorites.splice(index, 1);
                    }
                    favoriButton.textContent = 'Ajouter aux favoris';
                    favoriButton.style.backgroundColor = '#efefef';
                }
                localStorage.setItem('favorites', JSON.stringify(favorites)); // Stocker les favoris dans le localStorage
                console.log(isFavori ? 'Ajout du livre aux favoris:' : 'Retrait du livre des favoris:', book);
            });
            container.appendChild(bookCard);
        })
        .catch(err => {
            console.log(err);
            container.innerHTML = '<h2>Something went wrong</h2>';
        });
    });
}

// écouter le clic sur le bouton de recherche
btn.addEventListener('click', () => {
    search();
});

// écouter la touche Entrée pour déclencher la recherche
input.addEventListener('keyup', (event) => {
    if (event.key === 'Enter') {
        search();
    }
});

// écouter le clic sur le bouton de favoris, pour afficher les favoris
favorisBtn.addEventListener('click', showFavorites);