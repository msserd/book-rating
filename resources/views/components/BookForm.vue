<template>
    <SForm @submit.prevent="$emit('update')" :modelValue="modelValue">
        <SFormRow title="Название" name="title">
            <SInput ref="inputTitle" />
            <div class="form-text text-danger" v-if="errorTitle">Название не должно быть пустым.</div>
        </SFormRow>

        <SFormRow title="Описание" name="descr">
            <SInput type="textarea"/>
        </SFormRow>

        <SFormRow title="Обложка" name="img">
            <SInput />
        </SFormRow>

        <SFormRow title="Жанр">
            <select class="form-select" multiple aria-label="multiple select example" v-model="modelValue.genre">
                <option v-for="genre in genres">{{ genre }}</option>
            </select>
        </SFormRow>

        <SFormRow name="adult">
            <SCheckbox>18+</SCheckbox>
        </SFormRow>
        
        <div class="justify-content-between d-flex">
            <SButton color="green" type="submit">Сохранить</SButton>
            <SButton color="red" @click.prevent="$emit('close')">Закрыть</SButton>
        </div>
    </SForm>
</template>

<script setup>
    import { ref, watch } from 'vue'
    // import debounce from 'lodash/debounce'
    import { SForm, SFormRow, SInput, SCheckbox, SButton } from 'startup-ui';

    const inputTitle = ref(null)

    const emit = defineEmits(['update', 'close']);
    const props = defineProps({
        modelValue: Object,
        errorTitle: Boolean
    });

    const focusTitle = () => {
        inputTitle.value?.$el.querySelector('input').focus()
    }

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

    watch(() => props.modelValue.title, (newTitle) => {
            if (!newTitle) return
            sendTitle(newTitle)
        },
    )

    watch(() => props.errorTitle, (isError) => {
        if (isError){
            focusTitle();
        }
    })

    // const sendTitle = debounce((value) => {
    //     console.log(`Отправили "${value}" на сервер`)
    // }, 500)

    defineExpose({focusTitle})
</script>