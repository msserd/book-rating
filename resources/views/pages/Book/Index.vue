<template>
    <h1 class="header py-2">
        {{ title }}
    </h1>
    <div v-if="authUser && authUser.username" class="justify-content-center d-flex gap-2">
        <SButton color="green" @click="addBook">Добавить книгу</SButton>
        <SButton v-if="isMyBooks || (authUser && authUser.role === 'admin' && !isMyBooks)"
            color="red" @click="resetRatings">{{ isMyBooks ? 'Сбросить мои оценки' : 'Сбросить весь рейтинг' }}</SButton>
    </div>
    <div v-if="stats && stats.count" class="text-white justify-content-center d-flex mt-3">
        <div class="card mx-auto text-dark p-2">
        <span>Всего книг: {{ stats.count }} шт.</span>
        <span>Средний рейтинг: {{ stats.total_avg }}</span>
        </div>
    </div>
    <div class="books p-3">
        <BookCard v-for="book in props.books" :key="book.id" :book="book" :isMyBooks="isMyBooks" :authUser="authUser"/>
    </div>
</template>

<script setup>
    import BookCard from '../../components/BookCard.vue';

    import { SButton } from 'startup-ui';
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        books: Array,
        stats: {
            type: Object,
            default() {
                return {};
            }
        },
        title: String,
        isMyBooks: Boolean,
        authUser: {
            type: Object,
            default() {
                return {};
            }
        },
    })

    const addBook = () => {
        router.get('/books/create');
    }

    const resetRatings = () => {
            const message = props.isMyBooks
                ? 'Сбросить все ваши оценки?'
                : 'Сбросить весь рейтинг пользователей?';

            const url = props.isMyBooks ? '/ratings/reset-my' : '/ratings/reset-all';

            if (confirm(message)) {
                router.post(url, {}, { preserveScroll: true });
            }
        };
</script>

<style>
    .header{
        text-align: center;
    }
</style>
