<template layout="default">

<div class="py-4 text-center">
  <h1 class="text-4xl font-bold mb-6">User Login</h1>
  <div class="max-w-sm mx-auto bg-[#E4DCCF] border border-gray-400 shadow mt-4 p-6 rounded">

    <form @submit.prevent="submit">
      <div class="mb-6">
        <label for="email" class="block mb-2 text-lg font-medium text-gray-700">Email:</label>
        <input v-model="form.email" type="text" class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none" />
        <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.email">{{ form.errors.email }}</div>
      </div>

      <div class="mb-6">
        <label for="password" class="block mb-2 text-lg font-medium text-gray-700">Password:</label>
        <input v-model="form.password" type="password" class="w-full px-4 py-2 border border-gray-400 rounded-md focus:outline-none" />
        <div class="text-sm text-red-500 italic mt-1" v-if="form.errors.password">{{ form.errors.password }}</div>
      </div>

      <div class="flex items-center justify-between mb-6">
        <Link href="/user/register" class="text-blue-600 underline">Don't have an account?</Link>
        <button type="submit" class="py-2 px-6 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-md disabled:bg-gray-300 focus:outline-none">
          Log In
        </button>
      </div>

      <div class="text-sm text-red-500 italic" v-if="form.errors.authentication">{{ form.errors.authentication }}</div>
    </form>

  </div>
</div>


</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'

let form = useForm({
    'email': '',
    'password': ''
})

let submit = () => {
    form.post('/login')
}

</script>
