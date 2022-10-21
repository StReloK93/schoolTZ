<template>
    <div class="w-3/4">
        <TimeTable :timeTable="timeTable" />
    </div>
</template>

<script setup>
import axios from 'axios'
import TimeTable from '@/components/Timetable.vue'
import { ref } from 'vue'
import { useStore } from 'vuex'
const store = useStore()
const timeTable = ref()

axios.get(`timetables/group/${store.state.user.group_id}`).then((response) => {
    timeTable.value = response.data
})
</script>