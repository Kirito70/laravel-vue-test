<script setup>
import { ArrowLeftIcon} from "@heroicons/vue/20/solid";
</script>
<template>
  <div class="group block mx-auto w-1/2 shadow-lg border m-4 mt-5 p-5 rounded-2xl">

     <div  class="flex bg-blue-900 p-3 rounded-t-2xl " >
         <div>
           <router-link  to="/companies" class="text-blue-900"><ArrowLeftIcon class="h-50 w-50 text-white"/>back </router-link>
         </div>
        <div class="p-2 ">
          <h1 class=" text-xl text-white font-bold">Employees </h1>
        </div>

      </div>


    <div class=" m-4">
      <label>First name*</label>
      <input required type="text"  name="emp" class="bg-transparent mt-1 px-3 py-2  border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>

      <label>Last name*</label>
      <input required type="text"  name="emp" class="bg-transparent mt-1 px-3 py-2  border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>

       <label>Company*</label>
        <br>

      <select class="border border-blue-400 bg-transparent p-2 rounded-l rounded-r">
        <option class="border bg-transparent">Select</option>
        <option>company1</option>
        <option>company2</option>
        <option>company3</option>
        <option>company4</option>
      </select>
        <br>
        <br>
       <label>Email*</label>
      <input required type="email"  name="email" class=" bg-transparent  mt-1 px-3 py-2  border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>

       <label>Phone*</label>
      <input required type="number"  name="phone" class=" bg-transparent mt-1 px-3 py-2  border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>


      <button  type="submit" class="rounded-xl bg-cyan-600 text-white p-2 hover:bg-cyan-700  p-2 px-5 m-3">Add</button>

    </div>
     </div>
</template>

<style scoped>

</style>