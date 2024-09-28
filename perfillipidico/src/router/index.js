import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import listarView from '../views/listarView.vue'
import crearView from '../views/crearView.vue'
import editarView from '../views/editarView.vue'
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/listar',
    name: 'listar',
    component: listarView
  },
  {
    path: '/crear',
    name: 'crear',
    component: crearView
  },
  {
    path: '/editar',
    name: 'editar',
    component: editarView
  },
  
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
