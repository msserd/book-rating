<template>
    <SCanvas>
        <div class="d-flex gap-2 justify-content-center mt-3">
            <Link class="btn btn-primary" :class="{ active: $page.url === '/' }" href="/">Рейтинг книг</Link>
            <Link class="btn btn-primary" :class="{ active: $page.url === '/about' }" href="/about">О нас</Link>
            <Link class="btn btn-primary" :class="{ active: $page.url === '/dashboard' }" href="/dashboard">Дашборд</Link>
            <Link class="btn btn-primary" :class="{ active: $page.url === '/profile' }" href="/profile">Профиль</Link>
            <Link class="btn btn-primary" :class="{ active: $page.url === '/scroll' }" href="/scroll">Скролл</Link>
            <Link class="btn btn-primary" :class="{ active: $page.url === '/form' }" href="/form">Форма</Link>
        </div>
        <div class="app">
            <slot />
        </div>
    </SCanvas>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { SCanvas } from 'startup-ui';
</script>
<style>
    .app{
        max-width: 1500px;
    }

    #app{
        min-height: 100vh;
        background-image: url('images/bg.jpg');
    }

    .s-canvas-header{
        justify-content: center !important;
    }

    .s-canvas .s-section-h{
        /* padding-top: 0 !important; */
    }

    .s-button>svg:only-child{
        margin-right: 0!important;
    }
</style>