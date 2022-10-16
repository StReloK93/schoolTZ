export default [
	{
		path: '/',
		redirect: { name: 'login' },
		meta: {
			guard: 'guest'
		}
	},
	{
		path: '/login',
		component: () => import('../pages/Login.vue'),
		name: 'login',
		meta: {
			guard: 'guest'
		}
	},
	{
		path: '/register',
		component: () => import('../pages/Register.vue'),
		name: 'register',
		meta: {
			guard: 'guest'
		}
	},


	{
		path: '/director',
		component: () => import('../pages/Director/HomeDirector.vue'),
		name: 'home1',
		props: true,
		meta: {
			guard: 'auth',
			role: 1,
		},
		redirect: {
			name: 'groupsdirector'
		},
		children: [
			{
				path: '',
				name: 'groupsdirector',
				component: () => import('../pages/Director/Routes/GroupsDirector.vue')
			},
			{
				path: 'subjects',
				name: 'subjectsdirector',
				component: () => import('../pages/Director/Routes/SubjectsDirector.vue')
			},
			{
				props: true,
				path: 'groups/:id',
				name: 'singlegroupdirector',
				component: () => import('../pages/Director/Routes/SingleGroupDirector.vue')
			},
		]
	},




	{
		path: '/teacher',
		component: () => import('../pages/Teacher/HomeTeacher.vue'),
		name: 'home2',
		meta: {
			guard: 'auth',
			role: 2,
		},
		children: [
			{
				path: 'student',
				name: 'studentteacher',
				component: () => import('../pages/Teacher/StudentTeacher.vue')
			},
		]
	},
	{
		path: '/student',
		component: () => import('../pages/Student/HomeStudent.vue'),
		name: 'home3',
		meta: {
			guard: 'auth',
			role: 3,
		},
	},




	// 
	{
		path: '/:pathMatch(.*)*',
		redirect: '/',
		name: 'pathMatch',
		meta: { title: 'all' }
	}
];