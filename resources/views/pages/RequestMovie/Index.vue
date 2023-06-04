<template layout>
    <div class="p-8">
      <h1 class="text-3xl mb-6">Movie Requests</h1>

      <table class="min-w-full bg-white border border-gray-300">
        <colgroup>
          <col class="border-r border-gray-300">
          <col>
        </colgroup>
        <thead>
          <tr>
            <th class="py-3 px-3 bg-gray-300 font-medium text-gray-900 uppercase tracking-wider">Title</th>
            <th class="py-3 px-3 bg-gray-300 font-medium text-gray-900 uppercase tracking-wider">Director</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="requestmovie in requestmovies" :key="requestmovie.id" class="border-b border-gray-300 hover:bg-gray-400">
            <td class="py-4 px-3 text-center">{{ requestmovie.title }}</td>
            <td class="py-4 px-3 text-center">{{ requestmovie.director }}</td>
          </tr>
        </tbody>
      </table>

        <div class="flex justify-end mt-6">
            <Link v-if="isUser" href="/requests/add" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Request Movie</Link>
        </div>

    </div>
</template>

  <script setup>
  import { ref } from 'vue'
  import { Link } from '@inertiajs/inertia-vue3'


  let props = defineProps({
    requestmovies: Array,
    user: Array
  })

  const isUser = ref(false)

    if (props.user && props.user.role === 'user') {
        isUser.value = true;
    }
  </script>
