<?php include "../partials/header.php"; ?>


<section class="livre">
 
    <h1>Library</h1>

    <div class="search-bar">
        <form class="search">
            <input class="search-input" placeholder="Rechercher le livre" required="" type="text">
            <button class="reset" type="reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </form>
        <button class="submit" type="submit" >
            <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            Go</button>
        <button class="fav">Mes Livres</button>
    </div>
    <ul class="list"></ul>
    

    <!-- <script>
        const input = document.querySelector('input')
        const submit = document.querySelector('.submit')
        const favBtn = document.querySelector('.fav')
        const list = document.querySelector('.list')
        const favList = document.querySelector('.fav-list')

        submit.addEventListener('click', () => {
            const search = input.value
            const url = `https://www.googleapis.com/books/v1/volumes?q=${search}`
    
            axios.get(url)
            .then(res => {
                console.log(res)
                return res.data.items
            })
            .then(data => displayBooks(data))
            .catch(err => console.log(err))

        })

        favBtn.addEventListener('click', () => {
            // On recup les films depuis le local storage
            const favsArray = JSON.parse(localStorage.getItem('favs'))

            // On les affiche avec notre fonction displayBooks
            displayBooks(favsArray)
        })

        function displayBooks(books) {
            list.innerHTML = ""

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
                        <li id=${bookId}>ç
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

                            // On crée un objet avec les infos nécessaires pour notre film
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
                            const newArray = favsArray.filter((book) => book.imdbID != id)
    
                            // On sauvegarde le tableau des favoris dans le local storage
                            localStorage.setItem('favs', JSON.stringify(newArray))

                            displayBooks(newArray)
                        }
                    })
                    list.appendChild(li)
                })  
            } else {
                list.innerHTML = "<h2>Aucun film n'a été trouvé</h2>"
            }
        }

    </script> -->

    
</section>
    
<?php include "../partials/footer.php"; ?>