<template>
    <div>
        <h3 class="text-xl font-medium mb-3 text-blue-500">Subjects list</h3>
        <div v-for="subject in pageProps.subjects" :key="subject" class="w-1/4">
            <router-link
                :to="{ name: 'subjectstudent', params: { id: subject.id } }"
                class="flex justify-between bg-gray-100 mb-3 px-4 py-1.5 shadow"
            >
                <span>{{ subject.name }}</span>
                <span>|</span>
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import axios from "axios";

const pageProps = reactive({
    subjects: [],
});

axios.get("subjects").then((response) => {
    pageProps.subjects = response.data;
});
</script>