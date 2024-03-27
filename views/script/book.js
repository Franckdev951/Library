const input = document.querySelector('input')
const submit = document.querySelector('.submit')
const favBtn = document.querySelector('.fav')
const list = document.querySelector('.list')
const favList = document.querySelector('.fav-list')

submit.addEventListener('click', () => {
    // list.innerHTML = ""

    const search = input.value
    // const key = "AIzaSyBfcNwjLP_lCwWeILYccwf7SmBvXIUd2u8"
    const url = `https://www.googleapis.com/books/v1/volumes?q=${search}`
    
    axios.get(url)
    .then(res => {
        console.log(res)
        return res.data.items
    })
    .then(data => displayBooks(data))
    .catch(err => console.log(err))

})

// On écoute le bouton de fav 
favBtn.addEventListener('click', () => {
    // On recup les films depuis le local storage
    const favsArray = JSON.parse(localStorage.getItem('favs'))

    // On les affiche avec notre fonction displayMovies
    displayBooks(favsArray)
})

function displayBooks(books) {
    list.innerHTML = ""
    console.log(books)

    if (books) {
        books.forEach(book => {
            const title = book.volumeInfo.title;
            const author = book.volumeInfo.authors;
            const date = book.volumeInfo.publishedDate;
            const description = book.searchInfo.textSnippet;
            const img = book.volumeInfo.imageLinks.thumbnail;
            const bookId = book.id

            const li = document.createElement('li')

            // Selon si le film est un favoris ou non on affiche le bouton adéquat
            if (book.fav === true) {
                li.innerHTML = `
                <li id=${bookId}>
                    <h2>${title}</h2>
                    <h3>${author}</h3>
                    <img src=${img}>
                    <h3>${date}</h3>
                    
                    <button class="delFavBtn">Supprimer des favoris</button>
                </li>`
            } else {
                li.innerHTML = `
                <li id=${bookId}>
                    <h2>${title}</h2>
                    <h3>${author}</h3>
                    <img src=${img}>
                    <h3>${date}</h3>
                    
                    <button class="addFavBtn">Ajouter aux favoris</button>
                </li>`
            }

            // On écoute le bouton des favoris (soit ajout, soit suppression)
            li.addEventListener('click', (e) => {
                if (e.target.getAttribute('class') === 'addFavBtn') {

                    const id = e.target.parentElement.getAttribute('id')

                    // On crée un objet avec les infos nécess  aires pour notre film
                    const item = {
                        Title: title,
                        Image: img,
                        Date: date,
                        Description: description,
                        bookId: id,
                        fav: true
                    }

                    // On push l'objet à la fin du tableau des favs
                    // favs.push(item)

                    const favsArray = JSON.parse(localStorage.getItem('favs'))
                    favsArray.push(item)

                    // On sauvegarde le tableau des favoris dans le local storage
                    localStorage.setItem('favs', JSON.stringify(favsArray))

                } else if (e.target.getAttribute('class') === 'delFavBtn') {
                    
                    const favsArray = JSON.parse(localStorage.getItem('favs'))
                    const id = e.target.parentElement.getAttribute('id')

                    // Je filtre de mon tableau de favoris le film choisi via son imdbId 
                    const newArray = favsArray.filter((book) => book.bookId != id)
    
                    // On sauvegarde le tableau des favoris dans le local storage
                    localStorage.setItem('favs', JSON.stringify(newArray))

                    displayBooks(newArray)
                }
            })
            list.appendChild(li)
        })
    } else {
        list.innerHTML = "<h2>Aucun livre n'a été trouvé</h2>"
    }
}

