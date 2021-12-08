import Vue from "vue";
import VueRouter from "vue-router";
import AdminComponent from './components/AdminComponent';
import LoginComponent from './components/LoginComponent';
import HomeComponent from './components/HomeComponent';
import Profile from './components/Profile';
import Dashboard from './components/Dashboard';
import Users from './components/Users';



Vue.use(VueRouter)

let router = new VueRouter({
    mode: 'history',
    routes: [
        // { path: '*', require('./components/NotFoundComponent') },
        // { path: '*', redirect: '/' }, // catch all use case
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'Dashboard',
            beforeEnter: (to, from, next) => {
                if(localStorage.getItem('token')){
                    next();
                }
                else{
                    next('/login');
                }
            }
        },
        {
            path: '/profile',
            component: Profile,
            name: 'Profile'
        },
        {
            path: '/users',
            component: Users,
            name: 'Users'
        },
        {
            path: '/login',
            component: LoginComponent,
            name: 'LoginComponent'
        },
        {
            path:'/',
            component: HomeComponent,
            name: 'HomeComponent'
        }
    ]
})

// const routes = [
    

// ]
// export default new VueRouter({routes})

export default router