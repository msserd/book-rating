<template>
  <div class="card col pb-2 pt-3 rounded shadow-lg">
      <FontAwesomeIcon icon="star" class="book-star" :class="[book.average_rating ? 'book-star-active' : 'book-star-null'], 'book-star'"/>
      <span class="book-star-text">{{ book.average_rating ? Math.round(book.average_rating) : "&ndash;" }}</span>

      <img :src="getImageUrl(book.img)" class="card-img-top px-3">
      <div class="card-body">
          <h5 class="card-title">{{ book.title }}</h5>
          <p class="card-text">{{ book.description }}</p>
      </div>
      <ul class="list-group list-group-flush">
          <li class="list-group-item" v-if="book.genre">{{ book.genre }}</li>
          <li class="list-group-item" v-if="book.adult">18+</li>
          <li class="list-group-item">
            <div>Средний рейтинг</div>
            <div>{{ Number(book.average_rating || 0).toFixed(2) }}</div>
          </li>
          <li v-if="authUser && authUser.username" class="list-group-item">
            <div>Ваш рейтинг</div>
            <FontAwesomeIcon :icon="faStar" :class="[index <= book.user_rating ? 'text-warning' : 'text-secondary']" v-for="index in 5" @click="setRating(index)" />
          </li>
          <li v-if="authUser && authUser.username && (isMyBooks || authUser && authUser.role === 'admin')" class="list-group-item">
              <SButton color="green" class="me-2" @click="editBook(book.id)">
                <FontAwesomeIcon icon="pen-to-square" />
              </SButton>
              <SButton color="red" @click="deleteBook(book.id)">
                <FontAwesomeIcon icon="trash" />
              </SButton>
          </li>
      </ul>
  </div>
</template>

<script setup>
    import { SButton } from 'startup-ui';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
    import { faStar } from '@fortawesome/free-solid-svg-icons'
    import { router } from '@inertiajs/vue3';

    const emit = defineEmits(['edit', 'delete', 'rating']);
    const props = defineProps({
      book: Object,
      isMyBooks: Boolean,
      authUser: {
        type: Object,
        default() {
            return {};
        }
      },
    });

    const getImageUrl = (name) => {
        return `images/${name}`;
    }

    const editBook = (id) => {
      router.get(`/books/${id}/edit`);
    }

    const deleteBook = (id) => {
      if (confirm('Вы уверены, что хотите удалить эту книгу?')) {
          router.delete(`/books/${id}`, {
              preserveScroll: true, 
          });
      }
    };

    const setRating = (rating) => {
      router.post(`/books/${props.book.id}/rate`, { 
          rating: rating 
      }, { 
          preserveScroll: true 
      });
    }
</script>

<style lang="scss">
  .books{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(max(270px, 100%/5), 1fr));
    grid-gap: 32px 0;
    gap: 32px 0;

    .card{
      box-sizing: border-box;
      flex-direction: column;
      width: 250px;
      display: flex;
      gap: 10px;
      padding: 0 0 12px;
      margin: 0 auto;
      border-radius: 12px;
      position: relative;

      img{
        height: 300px;
      }
    }
  }

  .book-star{
    position: absolute;
    top: 25px;
    left: 20px;
    font-size: 35px;

    &-active{
      color: #ffc107 !important;
    }

    &-null{
      color: #6c757d;
    }

    &-text{
      position: absolute;
      top: 22px;
      left: 32px;
      font-size: 25px;
    }
  }

  .list-group-item svg{
    cursor: pointer;
  }
</style>