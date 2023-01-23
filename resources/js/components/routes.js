import { createRouter, createWebHistory } from 'vue-router'
 
import List from '../components/products/List'
import Add from '../components/products/Add'
import Edit from '../components/products/Edit'
import Login from '../components/user/Login'
 
const routes = [
    {
        path: '/',
        name: 'product.list',
        component: List
    },
	{
        path: '/add',
        name: 'product.add',
        component: Add
    },
	{
        path: '/edit/:id',
        name: 'product.edit',
        component: Edit
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
];
 
export default createRouter({
    history: createWebHistory(),
    routes
})