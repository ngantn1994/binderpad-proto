import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/settings',
    name: 'Settings',
    component: () => import(/* webpackChunkName: "settings" */ '../views/Settings.vue'),
    children: [
      {
        path: 'profile',
        name: 'ProfileSettings',
        component: () => import(/* webpackChunkName: "profilesettings" */ '../components/settings/ProfileSettings.vue'),
      },
      {
        path: 'account',
        name: 'AccountSettings',
        component: () => import(/* webpackChunkName: "accountsettings" */ '../components/settings/AccountSettings.vue'),
      },
    ],
  },
  {
    path: '/profile/:id',
    name: 'UserProfile',
    component: () => import(/* webpackChunkName: "profile" */ '../views/Profile.vue'),
    props: true,
  },
  {
    path: '/profile',
    name: 'Profile',
    component: () => import(/* webpackChunkName: "profile" */ '../views/Profile.vue'),
  },
  {
    path: '/create',
    name: 'Create',
    component: () => import(/* webpackChunkName: "create" */ '../views/Create.vue'),
    children: [
      {
        path: 'post',
        name: 'PostCreation',
        component: () => import(/* webpackChunkName: "postcreation" */ '../components/create/CreatePost.vue'),
      },
      {
        path: 'binder',
        name: 'BinderCreation',
        component: () => import(/* webpackChunkName: "bindercreation" */ '../components/create/CreateBinder.vue'),
      },
    ],
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
