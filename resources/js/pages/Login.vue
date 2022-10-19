<template>
	<section class="flex flex-col h-full w-full">
		<main class="flex-grow flex items-center justify-center">
			<form class="p-5 shadow-2xl flex" @submit.prevent="login">
				<section class="w-full bg-white relative">
                    <div>
                        student@mail.com
                    </div>
                    <div>
                        teacher@mail.com
                    </div>
                    <div>
                        director@mail.com
                    </div>

					<h3 class="text-gray-900 text-2xl text-center">Login</h3>
                    <select class="w-full outline-none py-2 capitalize -mx-1" v-if="roles" v-model="forminputs.role_id">
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                    </select>
					<p class="text-red-600">
						{{errorMessage}}
					</p>
					    <label class="text-gray-600 inline-block text-xs mb-2">Email</label>
                        <input type="text" class="w-full border-b outline-none" v-model="forminputs.email" required>
					<div>
						<label class="text-gray-600 text-xs">Password</label>
						<input type="password" class="w-full border-b mb-2  outline-none" v-model="forminputs.password" required/>
					</div>
					<div class="flex justify-between items-center">
						<router-link to="/register" class="bg-gray-200 border border-gray-200 text-center shadow-sm rounded text-gray-800 px-7 py-1">
                            Register
                        </router-link>
						<button type="submit" class="bg-green-600 text-center shadow-sm rounded text-white px-8 py-1.5 ml-5">
                            Sign in
                        </button>
					</div>
				</section>
			</form>
		</main>
	</section>
</template>
<script setup>
import { ref , reactive } from "@vue/runtime-core"
import axios from 'axios'
import { useStore } from 'vuex'
const store = useStore()


const forminputs = reactive({
    email: '',
    password: 'password',
    role_id: 1
})

const errorMessage = ref("")

function login(){
	
    store.dispatch('login', forminputs).then(res => {
        errorMessage.value = ""
    }, error => {
        const ErrorData = error.response.data.message
        errorMessage.value = ErrorData
        setTimeout(()=>{
            errorMessage.value = ""
        },3000)
    })
    
}


const roles = ref(null)
async function getRoles(){
    const { data } = await axios.get('/roles')
    roles.value = data
}

getRoles()
</script>