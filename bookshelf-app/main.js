const submitForm = document.getElementById('bookForm');
const incompleteBookList = document.getElementById("incompleteBookList");
const completeBookList = document.getElementById("completeBookList");
const searchBook = document.getElementById("searchBook");

const books = JSON.parse(localStorage.getItem("books")) || [];

const generateId = () => +new Date();

submitForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const book = {
        id: generateId(),
        title: document.getElementById("bookFormTitle").value,
        author: document.getElementById("bookFormAuthor").value,
        year: Number(document.getElementById("bookFormYear").value),
        isComplete: document.getElementById("bookFormIsComplete").checked,
    };

    books.push(book);

    localStorage.setItem("books", JSON.stringify(books));
    
    return window.location.reload();
});

function renderBookList() {
    incompleteBookList.innerHTML = ""; 
    completeBookList.innerHTML = "";

    books.forEach((book) => {
      const bookItem = document.createElement("div");
      bookItem.classList.add("boxBooks");
      bookItem.setAttribute("data-bookid", book.id);
      bookItem.setAttribute("data-testid", "bookItem");

      bookItem.innerHTML = `
        <h3 data-testid="bookItemTitle">${book.title}</h3>
        <p data-testid="bookItemAuthor">Author: ${book.author}</p>
        <p data-testid="bookItemYear">Year: ${book.year}</p>
        <div class="boxBtn">
          <button data-testid="bookItemIsCompleteButton">
            ${book.isComplete ? "Selesai dibaca" : "Belum selesai dibaca"}
          </button>
          <button data-testid="bookItemDeleteButton">Hapus Buku</button>
          <button data-testid="bookItemEditButton">Edit Buku</button>
        </div>
      `;

      bookItem.querySelector('[data-testid="bookItemIsCompleteButton"]').addEventListener("click", () => toggleCompleteStatus(book.id));
      bookItem.querySelector('[data-testid="bookItemDeleteButton"]').addEventListener("click", () => deleteBook(book.id));
      bookItem.querySelector('[data-testid="bookItemEditButton"]').addEventListener("click", () => editBook(book.id));

      if (book.isComplete === true) {
        completeBookList.appendChild(bookItem); 
      } else {
        incompleteBookList.appendChild(bookItem);
      }
    });
};

function deleteBook(id) {
    const index = books.findIndex(item => item.id == id);
    books.splice(index, 1);
    localStorage.setItem("books", JSON.stringify(books));
    return window.location.reload();
};

function toggleCompleteStatus(id){
    const index = books.findIndex(item => item.id == id);
    books[index].isComplete = !books[index].isComplete; 
    localStorage.setItem("books", JSON.stringify(books)); 
    return window.location.reload();
}

function editBook(id){
    const bookToEdit = books.find(item => item.id === id);

    if (bookToEdit) {
        document.getElementById('editBooktitle').value = bookToEdit.title;
        document.getElementById('editBookauthor').value = bookToEdit.author;
        document.getElementById('editBookyear').value = bookToEdit.year;
        document.getElementById('editBookIsComplete').checked = bookToEdit.isComplete;

        document.getElementById('editBookForm').style.display = 'block';

        editingBookId = id;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    renderBookList();
});

searchBook.addEventListener('submit', function (event) {
    event.preventDefault();
    const searchBookTitle = document.getElementById('searchBookTitle').value.toLowerCase();
    
    const filteredBooks = books.filter(item => item.title.toLowerCase().includes(searchBookTitle));

    incompleteBookList.innerHTML = "";
    completeBookList.innerHTML = "";

    if (filteredBooks.length > 0) {
        filteredBooks.forEach((book) => {
            const bookItem = document.createElement("div");
            bookItem.classList.add("boxBooks");
            bookItem.setAttribute("data-bookid", book.id);
            bookItem.setAttribute("data-testid", "bookItem");

            bookItem.innerHTML = `
                <h3 data-testid="bookItemTitle">${book.title}</h3>
                <p data-testid="bookItemAuthor">Author: ${book.author}</p>
                <p data-testid="bookItemYear">Year: ${book.year}</p>
                <div class="boxBtn">
                    <button data-testid="bookItemIsCompleteButton">
                        ${book.isComplete ? "Selesai dibaca" : "Belum selesai dibaca"}
                    </button>
                    <button data-testid="bookItemDeleteButton">Hapus Buku</button>
                    <button data-testid="bookItemEditButton">Edit Buku</button>
                </div>
            `;

            bookItem.querySelector('[data-testid="bookItemIsCompleteButton"]').addEventListener("click", () => toggleCompleteStatus(book.id));
            bookItem.querySelector('[data-testid="bookItemDeleteButton"]').addEventListener("click", () => deleteBook(book.id));
            bookItem.querySelector('[data-testid="bookItemEditButton"]').addEventListener("click", () => editBook(book.id));

            if (book.isComplete === true) {
                completeBookList.appendChild(bookItem);
            } else {
                incompleteBookList.appendChild(bookItem);
            }
        });
    } else {
        const noResultMessage = document.createElement('p');
        noResultMessage.textContent = 'Data Tidak Ada Atau Not Found';
        incompleteBookList.appendChild(noResultMessage);
        completeBookList.appendChild(noResultMessage);
    }
});

let editingBookId = null; 

function editBook(id) {
    const bookToEdit = books.find(item => item.id === id);

    if (bookToEdit) {
        document.getElementById('editBooktitle').value = bookToEdit.title;
        document.getElementById('editBookauthor').value = bookToEdit.author;
        document.getElementById('editBookyear').value = bookToEdit.year;
        document.getElementById('editBookIsComplete').checked = bookToEdit.isComplete;

        document.getElementById('editBookForm').style.display = 'block';

        editingBookId = id;
    }
}

document.getElementById('editBookForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const updatedtitle = document.getElementById('editBooktitle').value;
    const updatedauthor = document.getElementById('editBookauthor').value;
    const updatedyear = Number(document.getElementById('editBookyear').value);
    const updatedIsComplete = document.getElementById('editBookIsComplete').checked;

    const bookIndex = books.findIndex(item => item.id === editingBookId);
    if (bookIndex !== -1) {
        books[bookIndex].title = updatedtitle;
        books[bookIndex].author = updatedauthor;
        books[bookIndex].year = updatedyear;
        books[bookIndex].isComplete = updatedIsComplete;

        localStorage.setItem('books', JSON.stringify(books));

        document.getElementById('editBookForm').style.display = 'none';

        renderBookList();
    }
});

document.getElementById('cancelEdit').addEventListener('click', function () {
    document.getElementById('editBookForm').style.display = 'none';
});
