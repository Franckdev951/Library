const input = document.querySelector('input');
const submit = document.querySelector('.submit');
const favBtn = document.querySelector('.fav');
const list = document.querySelector('.list');
const favList = document.querySelector('.fav-list');

submit.addEventListener('click', () => {
    const search = input.value;
    const url = `https://www.googleapis.com/books/v1/volumes?q=${search}`;

    axios.get(url)
    .then(res => {
        console.log(res.data.items);
        return res.data.items;
    })
    .then(data => displayBooks(data))
    .catch(err => console.log(err));
});

favBtn.addEventListener('click', () => {
    // Récupérer les livres depuis le local storage
    const favsArray = JSON.parse(localStorage.getItem('favs'));

    // Afficher les livres favoris
    displayBooks(favsArray);
});
function displayBooks(books) {
    list.innerHTML = "";

    if (books && Array.isArray(books)){
        books.forEach(book => {
            if (book && book.volumeInfo && book.volumeInfo.title) {
            
                const bookId = book.id;
                const title = book.volumeInfo.title;
                const authors = book.volumeInfo.authors
                const date = book.volumeInfo.publishedDate;
                const img = book.volumeInfo.imageLinks.thumbnail;

                const li = document.createElement('li');

                if (book.fav === true) {
                    li.classList.add('book-fav');
                    li.innerHTML = `
                    <li classid=${bookId}>
                        <h2>${title}</h2>
                        <h3>${authors}</h3>
                        <img src=${img}>
                        <h3>${date}</h3>
                        <button class="delFavBtn">Supprimer des favoris</button>
                    </li>`;
                } else {
                    li.innerHTML = `
                    <li id=${bookId}>
                        <h2>${title}</h2>
                        <h3>${authors}</h3>
                        <img src=${img}>
                        <h3>${date}</h3>
                        <button class="addFavBtn">Ajouter aux favoris</button>
                    </li>`;
                }

                li.addEventListener('click', (e) => {
                    if (e.target.classList.contains('addFavBtn')) {
                        const id = e.target.parentElement.getAttribute('id');
                        const item = {
                            bookId: id,
                            volumeInfotitle : title,
                            authors: authors,
                            thumbnail: img,   
                            publishedDate: date,
                            fav: true
                        };

                        const favsArray = JSON.parse(localStorage.getItem('favs')) || [];
                        favsArray.push(item);
                        localStorage.setItem('favs', JSON.stringify(favsArray));
                    } else if (e.target.classList.contains('delFavBtn')) {
                        const favsArray = JSON.parse(localStorage.getItem('favs'));
                        const id = e.target.parentElement.getAttribute('id');
                        const newArray = favsArray.filter((book) => book.bookId !== id);
                        localStorage.setItem('favs', JSON.stringify(newArray));
                        displayBooks(newArray);
                    }
                });

                list.appendChild(li);
            }
        });
           
    } else {
        list.innerHTML = "<h2>Aucun livre n'a été trouvé</h2>";
    }
}
