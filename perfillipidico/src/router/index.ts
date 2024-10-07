import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import EspecialistaView from '../views/especialistaView.vue';
import CrearView from '../views/crearView.vue';
import DetallesView from '../views/detallesView.vue';
import BuscarView from '../views/buscarView.vue';
import ActualizarView from '../views/actualizarView.vue';


const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/especialista',
    name: 'especialista',
    component: EspecialistaView,
  },
  {
    path: '/crear',
    name: 'crear',
    component: CrearView,
  },
  {
    path: '/buscar',
    name: 'buscar',
    component: BuscarView,
  },
  {
    path: '/detalles/:Documento',
    name: 'detalles',
    component: DetallesView,
  },
  {
    path: '/actualizar/:Documento',
    name: 'actualizar',
    component: ActualizarView,
  },
  {
    path: '/nosotros',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;

