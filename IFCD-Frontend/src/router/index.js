import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store' // Make sure to adjust the path as per your store file location

Vue.use(VueRouter)

let routes = [
	{

		path: '*',
		component: () => import('../views/404.vue'),
	},

	{

		path: '/',
		name: 'Home',
		redirect: '/sign-in',
		meta: { guest: true }
	},
	{
		path: '/dashboard',
		name: 'Dashboard',
		layout: "dashboard",
		component: () => import(/* webpackChunkName: "dashboard" */ '../views/Dashboard.vue'),
		meta: { requiresAuth: true }
	},
	{
		path: '/politique',
		name: 'Politique',
		component: () => import(/* webpackChunkName: "dashboard" */ '../views/Politique.vue'),
		meta: { guest: true }
	},
	{
		path: '/terms',
		name: 'Terms',
		component: () => import(/* webpackChunkName: "dashboard" */ '../views/Terms.vue'),
		meta: { guest: true }
	},
	{
		path: '/mention',
		name: 'Mention',
		component: () => import(/* webpackChunkName: "dashboard" */ '../views/Mention.vue'),
		meta: { guest: true }
	},
	{
		path: '/condition',
		name: 'Condition',
		component: () => import(/* webpackChunkName: "dashboard" */ '../views/Condition.vue'),
		meta: { guest: true }
	},
	{
		path: '/layout',
		name: 'Layout',
		layout: "dashboard",
		component: () => import('../views/Layout.vue'),
		meta: { requiresAuth: true }
	},
	{
		path: '/tables',
		name: 'Organisations',
		layout: "dashboard",
		component: () => import('../views/Tables.vue'),
		meta: { requiresAuth: true }
	},
	{
		path: '/billing',
		name: 'Billing',
		layout: "dashboard",
		component: () => import('../views/Billing.vue'),
		meta: { requiresAuth: true }
	},
	{
		path: '/rtl',
		name: 'RTL',
		layout: "dashboard-rtl",
		meta: {
			layoutClass: 'dashboard-rtl',
			requiresAuth: true
		},
		component: () => import('../views/RTL.vue'),
	},
	{
		path: '/profile',
		name: 'Profile',
		layout: "dashboard",
		meta: {
			layoutClass: 'layout-profile',
			requiresAuth: true
		},
		component: () => import('../views/Profile.vue'),
	},
	{
		path: '/sign-in-default',
		name: 'Sign-In',
		component: () => import('../views/Sign-In.vue'),
		meta: { guest: true }
	},
	{
		path: '/sign-in',
		name: 'Sign-Up',
		meta: {
			layoutClass: 'layout-sign-up',
			guest: true // Fixed the duplicated `meta` property
		},
		component: () => import('../views/Sign-Up.vue')
	},
	// Catch-all route should be at the end
	{
		// will match everything
		path: '*',
		component: () => import('../views/404.vue'),
		meta: { guest: true }
	},
]

// Adding layout property from each route to the meta object
function addLayoutToRoute(route, parentLayout = "default") {
	route.meta = route.meta || {};
	route.meta.layout = route.layout || parentLayout;

	if (route.children) {
		route.children = route.children.map((childRoute) => addLayoutToRoute(childRoute, route.meta.layout));
	}
	return route;
}

routes = routes.map((route) => addLayoutToRoute(route));

const router = new VueRouter({
	mode: 'hash',
	base: process.env.BASE_URL,
	routes,
	scrollBehavior(to, from, savedPosition) {
		if (to.hash) {
			return {
				selector: to.hash,
				behavior: 'smooth',
			}
		}
		return {
			x: 0,
			y: 0,
			behavior: 'smooth',
		}
	}
})

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth) && !store.getters.isAuthenticated) {
		next('/sign-in');
	} else if (to.matched.some(record => record.meta.guest) && store.getters.isAuthenticated) {
		next('/dashboard');
	} else {
		next();
	}
});

export default router
