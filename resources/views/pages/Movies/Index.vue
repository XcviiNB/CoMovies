<template layout>
    <div class="p-8">
      <ConfirmationModal v-if="showConfirm" title="Delete Movie?" message="Are you sure you want to remove this movie?" @cancel="cancelDelete" @confirm="deleteMovie"></ConfirmationModal>

      <h1 class="text-4xl text-center mb-6">Movies</h1>

      <div class="flex justify-center mb-4">
        <select v-model="selectedGenre" class="px-4 py-2 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
          <option value="" hidden>All Genre</option>
          <option v-for="genre in uniqueGenres" :key="genre" :value="genre">{{ genre }}</option>
        </select>
        <input v-model="searchQuery" type="text" class="px-4 py-2 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 ml-4" placeholder="Search by title">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="movie of filteredMovies" :key="movie.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
          <img :src="getImageUrl(movie.image)" alt="Movie Cover" class="w-full h-56 object-cover">
          <div class="p-6">
            <h2 class="text-xl font-bold mb-2">{{ movie.title }}</h2>
            <p class="text-gray-600 mb-4">{{ movie.genre }}</p>
            <p class="text-gray-600 mb-4">Release Date: {{ movie.release_date }}</p>
            <p class="text-gray-600 mb-4">Director: {{ movie.director }}</p>
            <div class="flex justify-end">
              <Link v-if="isAdmin" :href="'/movies/edit/' + movie.id" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</Link>
              <button v-if="isAdmin" class="text-red-600 hover:text-red-800 font-bold px-5" @click="remove(movie)">Delete</button>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-center mt-6">
        <Link v-if="isAdmin" href="/movies/add" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Add New Movie</Link>
      </div>
    </div>
  </template>

  <script setup>
  import { Link, useForm } from '@inertiajs/inertia-vue3'
  import { defineProps, ref, computed } from 'vue'
  import ConfirmationModal from '@/views/components/ConfirmationModal.vue'

  let props = defineProps({
    movies: Array,
    user: Array
  })

  const showConfirm = ref(false)
  let selectedMovie = null

  const form = useForm({
    id: '',
    title: '',
    genre: '',
    release_date: '',
    image: '',
    director: ''
  })

  const deleteForm = useForm()

  function remove(movie) {
    selectedMovie = movie
    showConfirm.value = true
  }

  function cancelDelete() {
    showConfirm.value = false
  }

  async function deleteMovie() {
    if (selectedMovie !== null && selectedMovie.id !== undefined) {
      try {
        await deleteForm.delete('/movies/' + selectedMovie.id)
        deleteConfirmed.value = true
        showConfirm.value = false
      } catch (error) {
        showConfirm.value = false
      }
    }
  }

  function getImageUrl(image) {
    if (image.startsWith('http')) {
      return image;
    }

    return '/storage/' + image;
  }

  const isAdmin = ref(false)

  if (props.user && props.user.role === 'admin') {
    isAdmin.value = true;
  }

  const selectedGenre = ref('')
  const searchQuery = ref('')
  const uniqueGenres = computed(() => {
    const genres = props.movies.map(movie => movie.genre);
    return [''].concat([...new Set(genres)]);
  })
  const filteredMovies = computed(() => {
    let movies = props.movies

    if (selectedGenre.value) {
      movies = movies.filter(movie => movie.genre === selectedGenre.value)
    }

    if (searchQuery.value) {
      const query = searchQuery.value.toLowerCase()
      movies = movies.filter(movie => movie.title.toLowerCase().includes(query))
    }

    return movies
  })

  function filterMovies() {

  }

  </script>


  <style scoped>
  .text-center {
    text-align: center;
  }

  .bg-white {
    background-color: #fff;
  }

  .text-indigo-600 {
    color: #4c51bf;
  }

  .hover:text-indigo-900:hover {
    color: #2a4365;
  }

  .text-red-600 {
    color: #e53e3e;
  }

  .hover:text-red-800:hover {
    color: #991b1b;
  }

  .bg-indigo-600 {
    background-color: #4c51bf;
  }

  .hover:bg-indigo-700:hover {
    background-color: #4338ca;
  }

  .text-white {
    color: #fff;
  }

  .font-bold {
    font-weight: 700;
  }

  .py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
  }

  .px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
  }

  .rounded {
    border-radius: 0.375rem;
  }
  </style>
