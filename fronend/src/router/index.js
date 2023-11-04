import {createRouter, createWebHistory} from 'vue-router'
import LoginUser from "@/views/LoginUser.vue";
import EmployeeTable from "@/views/Employees/EmployeeTable.vue";
import CompanyTable from "@/views/Companies/CompanyTable.vue";
import PageLayout from "@/views/Layout/PageLayout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginUser,
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: PageLayout,
            children: [
                {
                    path: '/dashboard/employee-list',
                    name: 'employee',
                    component: EmployeeTable
                },
                {
                    path: '/dashboard/company-list',
                    name: 'companies',
                    component: CompanyTable
                }
            ]
        },
// {
//   path:'/addemployee',
//   name:'addemployee',
//   component: AddEmployee
// }
    ]
})

export default router