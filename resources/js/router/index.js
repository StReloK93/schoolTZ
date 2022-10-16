import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes.js'
import store from '../main/store'


const router = createRouter({
	history: createWebHistory(),
	routes
})

router.beforeEach((to, from, next) => {
	const user = store.state.user
	if (user) {
		if (to.meta.guard == 'guest') return next({ name: `home${user.role_id}` })

		if(to.meta.role == user.role_id) return next()
	}


	if (to.meta.guard == 'auth') return next({ name: 'login' })


	return next()
})

export default router;

