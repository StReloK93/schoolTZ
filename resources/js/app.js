import './bootstrap'
import { AgGridVue } from "ag-grid-vue3";
import { createApp } from 'vue'

import App from './main/App.vue'
import store from './main/store'
import router from './router'
import HomePage from './components/HomePage.vue'


store.dispatch('getUser').then(() => {

    createApp(App)
        .component('HomePage', HomePage)
        .component('AgGridVue', AgGridVue)
        .use(store)
        .use(router)
        .mount("#app")

})