<template layout>
    <div>
      <h1 class="text-2xl font-bold mb-4 text-center mt-7">Add Movie</h1>

      <div class="max-w-md mx-auto shadow p-4 mt-4 bg-white rounded-md">
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label for="title" class="block font-medium text-black mb-2">Title</label>
            <input v-model="form.title" type="text" id="title" name="title" class="w-full border border-gray-400 rounded-sm shadow-sm" />
            <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.title">{{ form.errors.title }}</div>
          </div>
          <div class="mb-4">
            <label for="release_date" class="block font-medium text-black mb-2">Release Date</label>
            <input v-model="form.release_date" type="date" id="release_date" name="release_date" class="w-full border border-gray-400 rounded-md shadow-sm" />
            <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.release_date">{{ form.errors.release_date }}</div>
          </div>
          <div class="mb-4">
            <label for="director" class="block font-medium text-black mb-2">Director</label>
            <input v-model="form.director" type="text" id="director" name="director" class="w-full border border-gray-400 rounded-md shadow-sm" />
            <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.director">{{ form.errors.director }}</div>
          </div>
          <div class="mb-4">
            <label for="genre" class="block font-medium text-black mb-2">Genre</label>
            <input v-model="form.genre" type="text" id="genre" name="genre" class="w-full border border-gray-400 rounded-md shadow-sm" />
            <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.genre">{{ form.errors.genre }}</div>
          </div>
          <div class="mb-4">
            <label for="image" class="block font-medium text-black mb-2">Image</label>
            <input type="file" id="image" name="image" @change="handleFileUpload" accept="image/*" class="w-full" />
            <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.image">{{ form.errors.image }}</div>
          </div>
          <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
              Add Movie
            </button>
            <Link href="/movies" class="inline-flex justify-center py-2 px-4 ml-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 hover:bg-gray-500">
              Back to Movies
            </Link>
          </div>
        </form>
      </div>
    </div>
  </template>

  <script setup>
  import { useForm, Link } from '@inertiajs/inertia-vue3'
  import { defineProps } from 'vue'

  let form = useForm({
    title: '',
    release_date: '',
    director: '',
    genre: '',
    image: null,
  })

  let props = defineProps({
    movies: Array,
  })

  const submitForm = () => {
    form.post('/movies', {
      onSuccess: () => {
        console.log('Movie added successfully!');
        // Perform any additional actions upon successful submission
      },
    })
  }

  const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.image = file;
  }
  </script>

  <style scoped>
  .text-center {
    text-align: center;
  }

  .text-black {
    color: #000;
  }

  .font-medium {
    font-weight: 500;
  }

  .mb-4 {
    margin-bottom: 1rem;
  }

  .w-full {
    width: 100%;
  }

  .border {
    border-width: 1px;
  }

  .border-gray-400 {
    border-color: #CBD5E0;
  }

  .rounded-sm {
    border-radius: 0.125rem;
  }

  .shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  }

  .text-red-500 {
    color: #EF4444;
  }

  .italic {
    font-style: italic;
  }

  .flex {
    display: flex;
  }

  .justify-end {
    justify-content: flex-end;
  }

  .py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }

  .px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
  }

  .border-transparent {
    border-color: transparent;
  }

  .rounded-md {
    border-radius: 0.375rem;
  }

  .text-white {
    color: #fff;
  }

  .bg-blue-500 {
    background-color: #3B82F6;
  }

  .hover\:bg-blue-700:hover {
    background-color: #1D4ED8;
  }

  .bg-gray-300 {
    background-color: #D1D5DB;
  }

  .hover\:bg-gray-400:hover {
    background-color: #9CA3AF;
  }

  </style>
