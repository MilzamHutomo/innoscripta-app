<script setup>
    defineProps({
        backgroundColor: { 
            type: String,
            default: 'bg-white'
        }
    })
</script>

<template>
    <div class="p-6 overflow-hidden shadow-sm sm:rounded-lg" :class="backgroundColor">
        <slot />
    </div>
</template>