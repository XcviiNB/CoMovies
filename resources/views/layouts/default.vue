<script setup lang="ts">
    import Navbar from '../components/navbar.vue'
    import Footer from '../components/footer.vue'
    import { defineProps } from 'vue'

    defineProps({
        'auth': Object
    })
</script>

<template>
    <Navbar :user="auth.user"></Navbar>
    <div class="flex flex-col min-h-screen">
        <main class="flex-grow">
            <slot />
        </main>
    </div>
    <Footer></Footer>
</template>
