import { createStore } from 'vuex'
import axios from 'axios'
import router from '../router/index'


export default createStore({
    state() {
        return {
            user: null,
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        }
    },
    actions: {

        async login({ state, dispatch }, data) {
            const result = await axios.post('login', data)
            
            localStorage.setItem('token', `${result.data.type} ${result.data.token}`) // local
            await dispatch('getUser')
            router.push({ name: `home${state.user.role_id}` })
        },

        async register({ dispatch }, props) {
            const result = await axios.post(props.path, props.formdata)
            if (result.status == 200) dispatch('login', props.formdata)
        },


        async logout({ commit }) {
            const data = await axios.get('logout')

            if (data.status == 200) {
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token')
                commit('setUser', null)
                router.push({ name: 'login' })
            }
            
        },

        async getUser({ commit }) {
            axios.defaults.headers.common['Authorization'] = localStorage.getItem('token')
            await axios.get('user').then((res) => {
                commit('setUser', res.data);
            }).catch(() => { console.clear() })
        },
    },
})
