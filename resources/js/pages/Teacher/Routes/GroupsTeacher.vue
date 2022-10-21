<template>
    <section class="h-full flex flex-col">
        <h3 class="text-xl font-medium mb-3 text-blue-500">Groups list</h3>
        <AgGridVue
            class="ag-theme-alpine h-full"
            :animateRows="true"
            :columnDefs="pageProps.columnDefs"
            :rowData="pageProps.rowData"
        />


        <section v-if="pageProps.timeTable" @click="pageProps.timeTable = null" 
            class="fixed top-0 left-0 bg-black z-50 w-full h-full bg-opacity-50 flex justify-center items-center">

            <main @click.stop class="bg-white p-4 text-right relative">
                <button class="absolute hover:rotate-90 transition-all right-4" @click="pageProps.timeTable = null">
                    <img src="/icons/close.svg" class="w-5">
                </button>
                <Timetable   :timeTable="pageProps.timeTable"/>
            </main>
            
        </section>

    </section>
</template>

<script setup>
import Timetable from '@/components/Timetable.vue'
import { reactive } from "vue";
import { useRouter } from 'vue-router'
import axios from "axios";

const router = useRouter()
const pageProps = reactive({
    columnDefs: [
        { field: "id", sortable: true, width: 70 },
        { field: "name", flex: 1, editable: true, sortable: true },
        { headerName: "Number of students", cellRenderer: (params) => params.data.students_count},
        { field: "created_at", sortable: true },
        {
            headerName: "Timetable", width: 100,
            cellClass: [
                "flex",
                "items-center",
                "cursor-pointer",
                "hover:bg-gray-300",
                "justify-center",
            ],
            cellRenderer: () => "<img src='/icons/table.svg' class='w-5'>",
            onCellClicked: (params) => openTimeTable(params),
        },
        {
            headerName: "view", width: 70,
            cellClass: [
                "flex",
                "items-center",
                "cursor-pointer",
                "hover:bg-gray-300",
                "justify-center",
            ],
            cellRenderer: () => "<img src='/icons/right.svg' class='w-5'>",
            onCellClicked: (params) => goToGroup(params),
        },
    ],
    timeTable: null,
});

axios.get("groups").then((response) => {
    pageProps.rowData = response.data;
});

function goToGroup(params){
    const row = params.data;

    router.push({ name: 'singlegroupsteacher' , params: {group_id: row.id} })
}

function openTimeTable(params){
    const row = params.data;

    axios.get(`timetables/group/${row.id}`).then((response) => {
        pageProps.timeTable = response.data
    })
}
</script>