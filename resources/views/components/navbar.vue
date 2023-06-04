<template>
    <section class="bg-primary">
      <nav class="bg-[#137fb0] p-5">
        <div class="container mx-auto flex items-center justify-between">
          <Link href="#" class="text-black font-bold text-2xl">CoMovies</Link>

          <div class="flex items-center space-x-4">
            <Link v-if="user" href="/movies" class="text-black font-semibold hover:text-gray-700">Movies</Link>
            <Link v-if="user" href="/requests" class="text-black font-semibold hover:text-gray-700">Movie Requests</Link>

            <div>
              <Link v-if="!user" class="text-black font-semibold hover:text-gray-700" href="/login">Log In</Link>
              <Link v-if="user" class="text-black font-semibold hover:text-gray-700" href="/logout" method="post" as="button">Log Out {{"|" + " " + user.name}}</Link>
            </div>
          </div>
        </div>
      </nav>
    </section>
  </template>

  <script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    import { defineProps } from 'vue'

    defineProps({
      user: ''
    })
  </script>

  <style scoped>
    .bg-primary {
      background-color: #1a202c;
    }

    .text-black {
      color: #000;
    }

    .text-2xl {
      font-size: 1.5rem;
    }

    .text-gray-700 {
      color: #4a5568;
    }

    .font-bold {
      font-weight: bold;
    }

    .font-semibold {
      font-weight: 600;
    }

    .hover:text-gray-700:hover {
      color: #4a5568;
    }

    .flex {
      display: flex;
    }

    .items-center {
      align-items: center;
    }

    .justify-between {
      justify-content: space-between;
    }

    .space-x-4 > * + * {
      margin-left: 1rem;
    }

    .container {
      width: 100%;
      max-width: 960px;
      padding-right: 1rem;
      padding-left: 1rem;
      margin-right: auto;
      margin-left: auto;
    }
  </style>
