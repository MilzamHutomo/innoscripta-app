<script setup>
import Card from './Card.vue';

const props = defineProps({
    close: { type: Function },
    show: { 
        type: Boolean,
        default: false
    }
})

</script>

<template>
    <div :class="{ 'hidden': show === false }">
        <div class="fixed w-full h-full bg-gray-400 opacity-50 top-0 left-0" />
        <div class="absolute top-0 p-10 w-full">
            <div class="w-full max-w-2xl mx-auto">
                <Card>
                    <slot />
                </Card>
            </div>
        </div>
    </div>
</template>