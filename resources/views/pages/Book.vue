<template>
    <MainLayout>    
        <h1 class="header py-2">
            Рейтинг книг
        </h1>
        <div class="justify-content-center d-flex gap-2">
            <SButton color="green" @click="openModal(0)">Добавить книгу</SButton>
            <SButton color="red" @click="clearRating">Сбросить рейтинг книг</SButton>
        </div>
        <div class="text-white justify-content-center d-flex mt-3">
            <div class="card mx-auto text-dark p-2">
            <span>Всего книг: {{ booksCount }} шт.</span>
            <span>Средний рейтинг: {{ avgRating }}</span>
            </div>
        </div>
        <div class="books p-3">
            <BookCard v-for="book in books" :key="book.id" :book="book" @edit="openModal" @delete="deleteBook" @rating="setRating"/>
        </div>

        <SDialog v-if="isModalOpen" v-model="isModalOpen" :title="modalTitle" @hide="closeModal">
            <BookForm ref="inputRef" :modelValue="bookData" :errorTitle="errorTitle" @update="updateBooks" @close="closeModal"/>
        </SDialog>
  </MainLayout>
</template>

<script setup>
  import { ref, computed, watch, nextTick } from 'vue'
  import BookCard from '../components/BookCard.vue';
  import BookForm from '../components/BookForm.vue';
  import MainLayout from '../layouts/MainLayout.vue'
  import { SButton, SDialog } from 'startup-ui';

  const props = defineProps({ books: Array })

  let books = ref(props.books)

  const inputRef = ref(null);
  const isModalOpen = ref(false);

  const bookData = ref({id: 0, title: '', descr: '', genre: [], img: '', adult: false, rating: 0});
  const modalTitle = ref('Добавление книги');
  const errorTitle = ref(false);

  function setRating(book_id, rating){
    books.value.find(book => book.id === book_id).rating = rating;
  }

  watch(isModalOpen, async (isOpen) => {
    if (isOpen){
      await nextTick()
      if (inputRef.value){
        inputRef.value.focusTitle();
      }
    }
  })

  function clearBookData(){
    bookData.value.id = 0;
    bookData.value.title = '';
    bookData.value.descr = '';
    bookData.value.genre = [];
    bookData.value.img = '';
    bookData.value.adult = false;
    bookData.value.rating = 0;

    errorTitle.value = false;
  }

  function closeModal(){
    isModalOpen.value = false;
    modalTitle.value = 'Добавление книги';
    clearBookData();
  }

  function openModal(book_id){
    if (book_id){
      const current_book = books.value.find(book => book.id === book_id);
      bookData.value.id = current_book.id;
      bookData.value.title = current_book.title;
      bookData.value.descr = current_book.descr;
      bookData.value.genre = current_book.genre.split(', ');
      bookData.value.img = current_book.img;
      bookData.value.adult = current_book.adult;
      bookData.value.rating = current_book.rating;

      modalTitle.value = 'Изменение книги';
    }
    isModalOpen.value = true;
  }

  function updateBooks(){
    if (bookData.value.title == ''){
      errorTitle.value = true;
      return;
    }
    if (bookData.value.id){
      const index = books.value.findIndex(book => book.id === bookData.value.id)
      if (index !== -1) {
        books.value[index].id = bookData.value.id;
        books.value[index].title = bookData.value.title;
        books.value[index].descr = bookData.value.descr;
        books.value[index].genre = bookData.value.genre.join(', ');
        books.value[index].img = bookData.value.img;
        books.value[index].adult = bookData.value.adult;
        books.value[index].rating = bookData.value.rating;
      }
    }else{
      const book = {
        id: books.value.length + 1, 
        title: bookData.value.title, 
        descr: bookData.value.descr, 
        genre: bookData.value.genre.join(', '), 
        img: bookData.value.img, 
        adult: bookData.value.adult, 
        rating: bookData.value.rating,
      };
      books.value.push(book);
    }
    closeModal();
  }

  function deleteBook(book_id){
    const index = books.value.findIndex(book => book.id === book_id)
    if (index !== -1) {
      books.value.splice(index, 1);
    }
  }

  function clearRating(event){
    books.value.forEach((item) => {
      item.rating = 0;
    })
    event.target.blur();
  }
  
  const booksCount = computed(() => books.value.length);

  const avgRating = computed(() => {
    let res = (books.value.reduce((acc, book) => acc + book.rating, 0) / books.value.length).toFixed(2);
    if (res == 0.0 || res == 'NaN')
      res = 0;
    return res;
  });
</script>

<style>
  .header{
    text-align: center;
    color: white;
  }
</style>