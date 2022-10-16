<template>
    <section class="h-full">
        <main class="flex flex-col h-full w-1/2">
            <h3 v-if="pageProps.group" class="text-xl font-medium mb-3 text-blue-500 flex justify-between items-center">
                <div>
                    <span class="text-gray-500">Group: </span>{{pageProps.group.name}}
                </div>
                <span class="text-gray-500">
                    {{pageProps.rowData.length}} students
                </span>
            </h3>
            <form @submit.prevent="addStudent" class="flex mb-3">
                <input type="text" required v-model="pageProps.input" class="flex-grow mr-3 border-b outline-none"/>
                <button class="px-2 py-1.5 bg-gray-200 hover:bg-gray-300 shadow-md flex items-center">
                    <img src="/icons/plus.svg" class="w-5 mr-2" /> Add Student
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
import { reactive } from "vue"
import axios from "axios"
const { id } = defineProps(['id'])


const pageProps = reactive({
    columnDefs: [
        { field: "id", sortable: true, width: 70 },
        { field: "name", flex: 1, editable: true, sortable: true },
        { field: "email", flex: 1, editable: true, sortable: true },
        { field: "created_at", sortable: true },
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
        }
    ],
    group: null,
});

axios.get(`groups/${id}`).then((response) => {
    pageProps.rowData = response.data.students;
    pageProps.group = response.data;
});

function onGridReady(params) {
    pageProps.gridApi = params.api;
}

function addStudent(){
    axios.post("students", { name: pageProps.input , group_id: id }).then((respone) => {
        pageProps.gridApi.applyTransaction({
            add: [respone.data],
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

    router.push({ name: `home${state.user.role_id}` })
}
</script>