<template>
    <div class="overlay">
        <div class="dialog-wrapper">
            <div class="dialog">
                <h3 class="text-3xl text-center mb-3">{{ title }}</h3>
                <hr class="border-black">
                <div class="mt-4 text-2xl text-center">
                    {{ message }}
                </div>
                <div class="flex justify-center space-x-2 mt-4">
                    <button class="bg-[#FAF0D8] rounded p-2 hover:bg-blue-400" @click="$emit('confirm')">
                        Confirm
                    </button>
                    <button class="bg-red-400 rounded p-2 hover:bg-red-500" @click="$emit('cancel')">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
let props = defineProps({
    title: "",
    message: ""
})
</script>
