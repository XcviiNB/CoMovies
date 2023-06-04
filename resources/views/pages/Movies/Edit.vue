<template layout>
    <h1 class="text-2xl font-bold mb-4 text-center">Edit Movie</h1>

    <div class="max-w-md mx-auto shadow p-4 mt-4 bg-[#E4DCCF] rounded-md">
      <form @submit.prevent="submit">
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
          <input
            type="file"
            id="image"
            name="image"
            ref="imageInput"
            accept="image/*"
            class="w-full border border-gray-400 rounded-md shadow-sm"
            @change="handleImageChange"
          />
          <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.image">{{ form.errors.image }}</div>
        </div>
        <div class="flex justify-evenly">
          <Link href="/movies" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#2C313E] hover:bg-[#1F232C]">Cancel</Link>
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#4594EE] hover:bg-[#1D76DB]">
            Save Changes
          </button>
        </div>
      </form>
    </div>
</template>

<script setup>
import { useForm, usePage, Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  movie: Object,
})

const form = useForm({
  title: props.movie.title,
  release_date: props.movie.release_date,
  director: props.movie.director,
  genre: props.movie.genre,
  image: null, // Initialize image as null
})

const submit = () => {
  // Append the image file to the form data
  const formData = new FormData()
  formData.append('title', form.title)
  formData.append('release_date', form.release_date)
  formData.append('director', form.director)
  formData.append('genre', form.genre)
  formData.append('image', form.image) // Append the image file

  form.put(`/movies/${props.movie.id}`, formData)
}

const handleImageChange = (event) => {
  const file = event.target.files[0]
  form.image = file
}
</script>
