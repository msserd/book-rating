<template>
    <h1 class="header py-2">
        Добавление книги
    </h1>
    <BookForm :form="form" @submit="submit"/>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    import BookForm from '../../components/BookForm.vue';

    const props = defineProps({ 
        backUrl: String,
    });

    const form = useForm({
        title: '',
        description: '',
        genre: '',
        adult: '',
        img: '',
        redirect_to: props.backUrl,
    });

    const submit = () => {
        form.post('/books');
    };
</script>