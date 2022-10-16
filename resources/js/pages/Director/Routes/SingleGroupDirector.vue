<template>
    <section class="h-full flex">
        <main class="flex flex-col h-full w-1/2">
            <h3 v-if="pageProps.group" class="text-xl font-medium mb-3 text-blue-500 flex justify-between items-center">
                <div>
                    <span class="text-gray-500">Group: </span>{{pageProps.group.name}}
                </div>
                <span class="text-gray-500">
                    {{pageProps.rowData.length}} students
                </span>
            </h3>
            <p class="text-red-600">{{pageProps.errorMessage}}</p>
            <AgGridVue
                class="ag-theme-alpine h-full"
                :animateRows="true"
                :columnDefs="pageProps.columnDefs"
                @grid-ready="onGridReady"
                :rowData="pageProps.rowData"
                @cellValueChanged="cellChanged"
                :undoRedoCellEditing="true"
                :enableCellChangeFlash="true"
            />
        </main>
        <main class="w-1/2 pl-4">
            <h3 class="text-xl font-medium mb-3 text-blue-500">Add student</h3>
            <form @submit.prevent="addStudent" class="w-full border-l pl-4">
                <div class="w-full">
                    <label>Name</label>
                    <input type="text" required v-model="pageProps.input" class="flex-grow mb-3 border-b w-full outline-none p-1.5"/>
                </div>
                <div class="w-full">
                    <label>Email</label>
                    <input type="email" required v-model="pageProps.email" class="flex-grow mb-3 border-b w-full outline-none p-1.5"/>
                </div>
                <div class="w-full">
                    <label>Password</label>
                    <input type="text" required v-model="pageProps.password" disabled class="flex-grow mb-3 border-b w-full outline-none p-1.5"/>
                </div>
                <button class="px-2 py-1.5 bg-gray-200 hover:bg-gray-300 shadow-md flex items-center">
                    <img src="/icons/plus.svg" class="w-5 mr-2" /> Add Student
                </button>
            </form>
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
        { field: "created_at",  sortable: true },
        {
            headerName: "Trash",  width: 70,
            field: "id",
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
    password: 'password',
});

axios.get(`groups/${id}`).then((response) => {
    pageProps.rowData = response.data.students;
    pageProps.group = response.data;
});

function onGridReady(params) {
    pageProps.gridApi = params.api;
}

function addStudent(){
    axios.post("students", { 
        name: pageProps.input ,
        email: pageProps.email, 
        group_id: id,
        password: pageProps.password,
        password_confirmation: pageProps.password,
    }).then((respone) => {
        pageProps.gridApi.applyTransaction({
            add: [respone.data],
        });
        pageProps.input = ""
        pageProps.email = ""
    } , error =>{
        const ErrorData = error.response.data.message
        pageProps.errorMessage = ErrorData
        setTimeout(() => pageProps.errorMessage = null, 3000);
    })
}


function cellChanged(params, event) {
    const row = params.data;
    axios.put(`students/${row.id}`, row).then((res) => false, error => {
        const ErrorData = error.response.data.message
        pageProps.errorMessage = ErrorData
        setTimeout(() => pageProps.errorMessage = null, 3000);
        pageProps.gridApi.undoCellEditing()
    });
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
            axios.delete(`students/${row.id}`).then((response) => {
                pageProps.gridApi.applyTransaction({ remove: [params.data] });
                pageProps.rowData.length -=  1
            });
        }
    });
}
</script>