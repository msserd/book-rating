<template> 
    <h1 class="header py-2">
        Редактирование книги {{ book.title }}
    </h1>
    <BookForm :form="form" @submit="submit"/>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import BookForm from '../../components/BookForm.vue';

    const props = defineProps({
        book: {
            type: Object,
            required: true
        },
        backUrl: String,
    });

    const form = useForm({
        title: props.book.title,
        description: props.book.description,
        genre: props.book.genre,
        adult: props.book.adult,
        img: props.book.img,
        redirect_to: props.backUrl,
    });

    const submit = () => {
        form.put(`/books/${props.book.id}`);
    };
</script>