import {createRouter, createWebHistory} from 'vue-router'
import LoginUser from "@/views/LoginUser.vue";
import EmployeeTable from "@/views/Employees/EmployeeTable.vue";
import CompanyList from "@/views/Companies/CompanyList.vue";
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
                    path: 'employee-list',
                    name: 'employees',
                    component: EmployeeTable
                },
                {
                    path: 'company-list',
                    name: 'companies',
                    component: CompanyList
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
