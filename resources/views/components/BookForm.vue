<template>
    <SForm @submit.prevent="$emit('submit')" v-model="form" class="mb-3">
        <SFormRow title="Название" name="title">
            <SInput />
            <div class="form-text text-danger" v-if="form.errors.title">{{ form.errors.title }}</div>
        </SFormRow>

        <SFormRow title="Описание" name="description">
            <SInput type="textarea"/>
            <div class="form-text text-danger" v-if="form.errors.description">{{ form.errors.description }}</div>
        </SFormRow>

        <SFormRow title="Обложка" name="img">
            <SInput />
        </SFormRow>

        <SFormRow title="Жанр">
            <select class="form-select" multiple aria-label="multiple select example" v-model="form.genre">
                <option v-for="genre in genres" :key="genre" :value="genre">{{ genre }}</option>
            </select>
            <div class="form-text text-danger" v-if="form.errors.description">{{ form.errors.description }}</div>
        </SFormRow>

        <SFormRow name="adult">
            <SCheckbox>18+</SCheckbox>
            <div class="form-text text-danger" v-if="form.errors.adult">{{ form.errors.adult }}</div>
        </SFormRow>
        
        <div class="d-flex gap-2">
            <SButton color="green" type="submit">Сохранить</SButton>
            <SButton color="red" @click.prevent="back">Отмена</SButton>
        </div>
    </SForm>
</template>

<script setup>
    import { ref } from 'vue'
    import { SForm, SFormRow, SInput, SCheckbox, SButton } from 'startup-ui';

    defineEmits(['submit']);

    const props = defineProps({
        form: Object,
        isEdit: { type: Boolean, default: false }
    });

    const form = props.form;
    
    const genres = ref([
        'Фантастика',
        'Драма',
        'Остросюжетный любовный роман',
        'Детектив',
        'Ужасы',
        'Триллер',
        'Приключения',
        'Приключенческая фантастика',
        'Исторические приключения',
        'Боевик',
        'Психология',
        'Учебная',
    ]);

    const back = () => {
        window.history.back();
    }
</script>