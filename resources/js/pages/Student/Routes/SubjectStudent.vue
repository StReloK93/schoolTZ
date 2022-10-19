<template>
    <div>
        <h3 class="text-xl font-medium mb-3 text-blue-500">Subjects: <span class="font-normal">{{pageProps.subject.name}} </span></h3>
        <h4 class="mb-3">Grades list</h4>
        <table class="table-auto border text-center w-1/2">
            <tr>
                <th class="border border-gray-400 bg-gray-200 p-2 w-10">№</th>
                <th class="border border-gray-400 bg-gray-200 p-2">Grade</th>
                <th class="border border-gray-400 bg-gray-200 p-2">Date</th>
            </tr>
            <tr v-for="(studentGrade , index) in  pageProps.subject.grades" :key="index">
                <td class="border p-2">{{index +1}}</td>
                <td class="border p-2">{{studentGrade.grade}}</td>
                <td class="border p-2">{{studentGrade.created_at}}</td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import axios from "axios";
const { id }  = defineProps(['id'])
const pageProps = reactive({
    subject: [],
});

axios.get(`studentsubjectgrades/${id}`).then((response) => {
    pageProps.subject = response.data;
});
</script>