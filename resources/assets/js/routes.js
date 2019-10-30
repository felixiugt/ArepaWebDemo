import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'home',
			component: require('./views/Home')
		},
		{
			path: '/people',
			name: 'people',
			component: require('./views/People')
		},
		{
			path: '*',
			component: require('./views/404')
		}
	],
	// mode: 'history',

})
