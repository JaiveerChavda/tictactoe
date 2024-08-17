<template>
    <AuthenticatedLayout>
        <h2>Testing!</h2>
        {{ $page.props }}
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    game: Object
})
</script>
