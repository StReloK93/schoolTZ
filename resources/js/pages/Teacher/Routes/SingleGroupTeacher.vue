<template>
    <section class="h-full flex flex-col">
        <select v-model="pageProps.selectedSubject" @change="getGrades" class="text-xl font-medium mb-3 text-blue-500 w-40">
            <option v-for="subject in pageProps.subjects" :value="subject.id">{{subject.name}} {{subject.id}}</option>
        </select>
        <AgGridVue class="ag-theme-alpine h-full" :animateRows="true" :columnDefs="pageProps.columnDefs" :rowData="pageProps.rowData"/>
    </section>
</template>

<script setup>
import { reactive } from "vue";
import { useRouter } from 'vue-router'
import axios from "axios";

const router = useRouter()
const { group_id } = defineProps(['group_id'])
const pageProps = reactive({
    columnDefs: [
        { field: "name", flex: 1 },
    ],
    subjects: [],
    selectedSubject: null,
});

axios.get('/subjects').then((response) => {
    pageProps.subjects = response.data
    pageProps.selectedSubject = pageProps.subjects[0].id
    getGrades()
})

function getGrades(){
    axios.get(`groups/${group_id}/${pageProps.selectedSubject}`).then((response) => {
        pageProps.rowData = response.data.students;
    });
}
</script>