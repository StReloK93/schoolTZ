<template>
    <div class="w-3/4">
        <main class="flex justify-between items-center">
            <h3 class="text-xl font-medium my-3 text-blue-500">Group Timetable</h3>
            <div>
                <button class="bg-gray-200 w-10 mr-4 text-red-500 font-bold">-</button>
                <button class="bg-gray-200 w-10 px-3 text-green-600 font-bold">+</button>
            </div>
        </main>
        <table class="border w-full">
            <tr>
                <th class="border p-1.5">№</th>
                <th class="border p-1.5">Monday</th>
                <th class="border p-1.5">Tuesday</th>
                <th class="border p-1.5">Wednesday</th>
                <th class="border p-1.5">Thursday</th>
                <th class="border p-1.5">Friday</th>
                <th class="border p-1.5">Saturday</th>
            </tr>
            <tr v-for="column in Timetable" :key="column">
                <td class="p-2 border">1</td>
                <td class="p-2 border">
                    <select v-model="column.monday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
                <td class="p-2 border">
                    <select v-model="column.tuesday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
                <td class="p-2 border">
                    <select v-model="column.wednesday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
                <td class="p-2 border">
                    <select v-model="column.thursday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
                <td class="p-2 border">
                    <select v-model="column.friday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
                <td class="p-2 border">
                    <select v-model="column.saturday" @change="changedTimetable(column.id)">
                        <option v-for="(subject, index) in proarray" :key="index" :value="index">{{subject}}</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
import { reactive } from 'vue'
const proarray = [
    null,
    'Literature',
    'History',
    'Mathematics',
    'Books',
    'Jobs',
]

const Timetable = reactive([
    {
        id: 1,
        monday: 1,
        tuesday: 3,
        wednesday: 2,
        thursday: 4,
        friday: 0,
        saturday: 2,
    },
    {
        id: 2,
        monday: 3,
        tuesday: 3,
        wednesday: 3,
        thursday: 3,
        friday: 3,
        saturday: 3,
    },
    {
        id: 3,
        monday: 2,
        tuesday: 3,
        wednesday: 3,
        thursday: 3,
        friday: 3,
        saturday: 3,
    },
    {
        id: 4,
        monday: 4,
        tuesday: 3,
        wednesday: 3,
        thursday: 3,
        friday: 3,
        saturday: 3,
    },
])

function changedTimetable(rowId){
    const changedRow = Timetable.find(row => row.id === rowId)

    console.log(changedRow)
}
</script>