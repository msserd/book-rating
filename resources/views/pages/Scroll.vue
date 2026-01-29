<template>
    <MainLayout>
        <h1 class="header py-2">
            Скролл
        </h1>
        <SNote class="text-center">
            <div v-for="text in texts">
                {{ text }}
            </div>
        </SNote>
        <div class="absolute-btns">
            <SButton color="green" @click="reloadPage(true)">Обновить без сброса</SButton>
            <SButton color="red" @click="reloadPage(false)">Обновить со сбросом</SButton>
        </div>
    </MainLayout>
</template>

<script setup>
    import { ref } from 'vue'
    import { router } from '@inertiajs/vue3'
    import { SNote, SButton } from 'startup-ui';
    import MainLayout from '../layouts/MainLayout.vue'
    

    const texts = ref(Array.from({ length: 100 }, () => 'Изучение Vue Route. Изучение Vue Route. Изучение Vue Route.'));

    const reloadPage = (preverse) => {
        if (preverse){
            router.visit('/scroll', {
                preserveScroll: true,
                preserveState: true
            })
        }else
            router.visit('/scroll')
    };
</script>
<style>
    .s-note{
        margin: 0 1rem;
    }

    .absolute-btns{
        display: grid;
        gap: 8px;
        position: fixed;
        top: 50vh;
        right: 1rem;
    }
</style>