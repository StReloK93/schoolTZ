<template>
    <div class="w-3/4">
        <main class="flex justify-between items-center">
            <h3 class="text-xl font-medium my-3 text-blue-500">Group Timetable</h3>
            <div>
                <button class="bg-gray-200 w-10 mr-4 text-red-500 font-bold">-</button>
                <button @click="addRow" class="bg-gray-200 w-10 px-3 text-green-600 font-bold">+</button>
            </div>
        </main>
        <table class="border w-full text-center">
            <tr class="bg-gray-100">
                <th class="border p-1.5">№</th>
                <th class="border p-1.5">Monday</th>
                <th class="border p-1.5">Tuesday</th>
                <th class="border p-1.5">Wednesday</th>
                <th class="border p-1.5">Thursday</th>
                <th class="border p-1.5">Friday</th>
                <th class="border p-1.5">Saturday</th>
                <th class="border p-1.5">Trash</th>
            </tr>
            <tr v-for="column in pageProps.timeTable" :key="column">
                <td class="border">{{column.id}}</td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.monday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.tuesday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.wednesday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.thursday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.friday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="w-full py-2 outline-none" v-model="column.saturday" @change="changedTimetable(column.id)">
                        <option value=""></option>
                        <option v-for="subject in pageProps.subjects" :key="subject" :value="subject.id">{{subject.name}}</option>
                    </select>
                </td>
                <td @click="deleteRow(column.id)"  class="border text-center hover:bg-gray-200 cursor-pointer">
                    <img src="/icons/trash.svg" class="w-6 inline">
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import axios from 'axios'
import { reactive } from 'vue'
const { id } = defineProps(['id'])

const pageProps = reactive({
    subjects: [],
    timeTable: [],
})




function changedTimetable(rowId){
    const changedRow = pageProps.timeTable.find(row => row.id === rowId)

    console.log(changedRow)
}

axios.get('/subjects').then((response) => {
    pageProps.subjects = response.data
})


axios.get(`timetables/group/${id}`).then((response) => {
    pageProps.timeTable = response.data
})


function addRow(){
    axios.post('timetables' ,{group_id: id}).then((response) => {
        pageProps.timeTable.push(response.data)
    })
}


function deleteRow(rowId){
    const index = pageProps.timeTable.findIndex(row => row.id === rowId)

    axios.delete(`timetables/${rowId}`).then(() => {
        pageProps.timeTable.splice(index , 1)
    })
}

</script>