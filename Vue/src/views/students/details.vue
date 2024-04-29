<template>
    <div class="mt-10">
        <div class="flex items-center justify-between mb-3">
            <div class="mb-3">
                <router-link :to="{ name: 'app.student.list' }"
                    class="bg-blue-700 focus:ring flex items-center justify-center gap-3  focus:ring-indigo-600 outline-none mb-6 rounded-lg shadow text-white py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    لسیت محصلین
                </router-link>
            </div>
            <div>
                <h1 class="text-xl font-bold mb-3">پروفایل &nbsp;&nbsp; {{ student_details.name }} {{ student_details.lname
                }}</h1>
            </div>
        </div>

        <!-- main content -->

        <div class="bg-white rounded-lg shadow py-8 px-8">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <div class="flex items-center justify-between">
                            <th>
                                <img :src="student_details.photo_path" width="100px" alt="">
                            </th>
                            <th>
                                <span class="bg-pink-300 py-3 px-3 rounded-lg shadow text-white">UnderGraduated</span>
                            </th>
                        </div>
                    </tr>
                    <br>

                    <tr class="bg-gray-100 py-10">
                        <th>نام و تخلص:</th> <span>{{ student_details.name }} {{ student_details.lname }}</span>
                        <th>نام پدر:</th><span>{{ student_details.fname }}</span>
                        <th>شماره تماس:</th><span>{{ student_details.phone }}</span>

                    </tr>
                    <br>
                    <tr class="bg-gray-100 py-10">
                        <th>ادرس ایمل:</th><span>{{ student_details.email }}</span>
                        <th>آی دی کانکور:</th><span>{{ student_details.kankor_id }}</span>
                        <th>نمره کانکور:</th><span>{{ student_details.kankor_mark }}</span>

                    </tr>
                    <br>
                    <tr class="bg-gray-100 py-10">
                        <th>ریشته درو لیسانس:</th><span>{{ student_details.bachelor_field }}</span>
                        <th>نمبر تذکره:</th><span>{{ student_details.nic }}</span>
                        <th> ادرس:</th><span>{{ student_details.address }}</span>
                        <th>تاریخ ثبت نام:</th><span>{{ student_details.admission_date }}</span>
                    </tr>
                </thead>
            </table>

        </div>


    </div>
</template>
<script setup>
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useStudentStore } from "../../stores/student/studentStore";


const studentStore = useStudentStore();
const route = useRoute();

const student_details = computed(() => studentStore.student_details);

onMounted(() => {
    studentStore.getStudentDetails(route.params.id);
})





</script>
