<script setup>
import {TrashIcon, PencilIcon, EyeIcon} from "@heroicons/vue/20/solid";
import axios from "axios";
import {onMounted} from "vue";
const employee_table = [
  {
    id : "1",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  },
    {
    id : "2",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  },
    {
    id : "3",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  },
    {
    id : "4",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  },{
    id : "5",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  },{
    id : "6",
    first_name:"fn",
    last_name:"un",
    company:"company name",
    email:"e@gmail.com",
    phone:"093429"
  }



]

const employee_list =()=> {
  axios.get("/employees").then((response)=>{
    console.log(response)
  })
}
onMounted(()=>{
  employee_list()
})
</script>

<template>
    <div class="group block mx-auto shadow-lg border m-4 mt-5 p-5 rounded-2xl ">

    <div  class="flex bg-blue-900 p-3 rounded-t-2xl justify-between" >
        <div class="p-2 ">
          <h1 class=" text-xl text-white font-bold">Employee </h1>
        </div>
         <div>
           <router-link to="/addemployee">
          <button class="addButton text-white  bg-cyan-600 text-white p-2 hover:bg-cyan-700  rounded-xl p-2 px-5 ">Add</button>
          </router-link>
         </div>
      </div>


    <table class="tw-table-auto tw-w-full">
      <thead class="tw-bg-blue-100">
        <tr>
          <th v-for="list in employee_table">
            {{key}}
          </th>
          <th>Actions</th>
       </tr>


        <tr class="tw-text-center">
          <td class="tw-py-2">001</td>
          <td class="actionIcons tw-flex tw-py-2 ">
            <EyeIcon class="tw-mx-3 tw-h-7 tw-w-5"></EyeIcon>
            <PencilIcon class="tw-mx-3 tw=h-7 tw-w-5"></PencilIcon>
            <TrashIcon class="tw-mx-3 tw-h-7 tw-w-5"></TrashIcon>
          </td>
        </tr>
      </thead>

    </table>
  </div>
</template>

<style scoped>
.actionIcons{
  margin-left: 4rem;
}


</style>
