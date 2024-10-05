import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import especialistaView from '../views/especialistaView.vue'
import crearView from '../views/crearView.vue'
import detallesView from '../views/detallesView.vue'
import buscarView from '../views/buscarView.vue'
import actualizarView from '../views/actualizarView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/especialista',
    name: 'especialista',
    component: especialistaView
  },
  {
    path: '/crear',
    name: 'crear',
    component: crearView
  },
  {
    path: '/buscar',
    name: 'buscar',
    component: buscarView
  },
  {
    path: '/detalles/:Documento',
    name: 'detalles',
    component: detallesView
  },
  {
    path: '/actualizar/:Documento',
    name: 'actualizar',
    component: actualizarView
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
