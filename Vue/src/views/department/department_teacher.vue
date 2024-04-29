<template>
  <div class="mt-10">
    <div class="flex items-center justify-between">
      <div>
        <router-link :to="{ name: 'app.faculty.list' }" class="btn-all">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5 text-white"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
            />
          </svg>
          برگشت به صفحه قبل
        </router-link>
      </div>
      <div>
        <h1 class="text-2xl font-semibold">لیست اساتید دیپارتمنت</h1>
      </div>

      <TeacherDepartment />
    </div>
  </div>
</template>

<script setup>
import TeacherDepartment from "./department_teacher.vue";
</script>
