<template>
    <MainLayout>
        <h1 class="header py-2">
            О нас
        </h1>
        <SNote>
            <span v-for="text in texts">
                {{ text }}
            </span>
            <br />
            <br />
            <div>Число - {{ integer }}</div>
            <div>Строка - {{ string }}</div>
            <div>Массив - {{ array }}</div>
            <div>Ассоциативный массив - {{ assocArray }}</div>
        </SNote>
    </MainLayout>
</template>

<script setup>
    import { ref } from 'vue'
    import { SNote } from 'startup-ui';
    import MainLayout from '../layouts/MainLayout.vue'

    const props = defineProps({
        integer: Number,
        string: String,
        array: Array,
        assocArray: Object,
    })

    const texts = ref(Array.from({ length: 15 }, () => 'Изучение Vue Route. '));
</script>
<style>
    .s-note{
        margin: 0 1rem;
    }
</style>