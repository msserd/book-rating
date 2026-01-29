<template>
    <MainLayout>
        <h1 class="header py-2">
            Форма
        </h1>
        <SNote>
            <SForm @submit.prevent="submit" v-model="form">
                <SFormRow title="Имя" name="name">
                    <SInput />
                </SFormRow>

                <SFormRow title="Email" name="email">
                    <SInput />
                </SFormRow>

                <SButton>{{ form.processing ? 'Отправка...' : 'Отправить' }}</SButton>
            </SForm>
        </SNote>
    </MainLayout>
</template>
<script setup>
    import { SNote, SFormRow, SInput, SForm, SButton } from 'startup-ui';
    import MainLayout from '../layouts/MainLayout.vue'
    import { useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: '',
        email: '',
    });

    const submit = () => {
        form.post('/form', {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        });
    };

</script>