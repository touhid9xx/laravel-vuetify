import Vue from 'vue';
import Router from 'vue-router';

import Home from './components/pages/home';
import About from './components/pages/about';
import NotFound from './components/pages/notfound';
import Blog from './components/pages/blog/blogs';
import Dashboard from './components/pages/dashboard';
import Profile from './components/pages/profile';
import Login from './components/pages/login';
import Register from './components/pages/register';
import Contact from './components/pages/contact';



Vue.use(Router);

const router =  new Router({
    routes: [
        { path: '/home', component: Home, name: 'home', redirect:'/'},
        { path: '/about', component: About, name: 'about' },
        { path: '/contact', component: Contact, name: 'contact' },
        { path: '/blog', component: Blog, name: 'blog' },
        { path: '/dashboard', component: Dashboard, name: 'dashboard'},
        { path: '/profile', component: Profile, name: 'profile'},
        { path: '/login', component: Login, name: 'login'},
        { path: '/register', component: Register, name: 'register'},
        // { path: '*', component: NotFound, redirect:'notfound'},
    ],
    mode: 'history',
  
});

// router.beforeEach((to, from, next) => {
//     const publicPages = ['home','about','contact','login','register'];
//     const authRequired = !publicPages.includes(to.path);
//     const loggedIn = localStorage.getItem('user');
  
//     // trying to access a restricted page + not logged in
//     // redirect to login page
//     if (authRequired && !loggedIn) {
//       next('/login');
//     } else {
//       next();
//     }
//   });


  export default router;