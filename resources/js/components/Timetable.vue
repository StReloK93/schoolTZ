<template>
    <div>
        <main class="flex justify-between items-center">
            <h3 class="text-xl font-medium my-3 text-blue-500">Timetable</h3>
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
            </tr>
            <tr v-for="column in timeTable" :key="column">
                <td class="border">{{column.id}}</td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.monday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}
                        </option>
                    </select>
                </td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.tuesday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.wednesday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.thursday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.friday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}</option>
                    </select>
                </td>
                <td class="border">
                    <select class="select w-full p-2 outline-none" disabled v-model="column.saturday">
                        <option v-for="subject in subjects" :key="subject" :value="subject.id" :title="subject.name">
                            {{subject.name}}</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref } from 'vue'
const { timeTable } = defineProps(['timeTable'])

const subjects = ref()
axios.get('/subjects').then((response) => {
    subjects.value = response.data
})
</script>
<style scoped>
.select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.select::-ms-expand {
    display: none;
    /* удалите стрелку по умолчанию в IE 10 и 11 */
}
</style>