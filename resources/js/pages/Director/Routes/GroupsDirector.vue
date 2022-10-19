<template>
    <section class="h-full">
        <main class="flex flex-col h-full">
            <h3 class="text-xl font-medium mb-3 text-blue-500">Groups list</h3>
            <form @submit.prevent="addSubject" class="flex mb-3 w-1/3">
                <input type="text" required v-model="pageProps.input" class="flex-grow mr-3 border-b outline-none"/>
                <button class="px-2 py-1.5 bg-gray-200 hover:bg-gray-300 shadow-md flex items-center">
                    <img src="/icons/plus.svg" class="w-5 mr-2" /> Add Group
                </button>
            </form>
            <AgGridVue
                class="ag-theme-alpine h-full"
                :animateRows="true"
                :columnDefs="pageProps.columnDefs"
                @grid-ready="onGridReady"
                :rowData="pageProps.rowData"
                @cellValueChanged="cellChanged"
            />
        </main>
    </section>
</template>

<script setup>
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
            onCellClicked: (params) => goToTimeTable(params),
        },
        {
            headerName: "Trash", width: 70,
            cellClass: [
                "flex",
                "items-center",
                "cursor-pointer",
                "hover:bg-gray-300",
                "justify-center",
            ],
            cellRenderer: () => "<img src='/icons/trash.svg' class='w-5'>",
            onCellClicked: (params) => rowDelete(params),
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
});

axios.get("groups").then((response) => {
    pageProps.rowData = response.data;
});

function onGridReady(params) {
    pageProps.gridApi = params.api;
}

function addSubject(){
    axios.post("groups", { name: pageProps.input }).then((respone) => {
        pageProps.gridApi.applyTransaction({
            add: [respone.data],
            // addIndex: 0,
        });
        pageProps.input = ""
    })
}


function cellChanged(params) {
    const row = params.data;
    axios.put(`groups/${row.id}`, row);
}

function rowDelete(params) {
    const row = params.data;
    Swal.fire({
        title: "Deletion",
        text: "Are you sure you want to delete it?",
        showCancelButton: true,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`groups/${row.id}`).then((response) => {
                pageProps.gridApi.applyTransaction({ remove: [params.data] });
            });
        }
    });
}


function goToGroup(params){
    const row = params.data;

    router.push({ name: 'singlegroupdirector' , params: {id: row.id} })
}

function goToTimeTable(params){
    const row = params.data;

    router.push({ name: 'timetabledirector' , params: {id: row.id} })
}
</script>