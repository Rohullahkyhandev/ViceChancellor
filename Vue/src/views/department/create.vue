<template>
    <div class="mt-10 mb-10 w-full">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link :to="{ name: 'app.faculty.details', params: { id: $route.params.id } }"
                    class="bg-blue-600 flex items-center justify-center gap-2 focus:ring focus:ring-blue-500 outline-none py-2 px-6 rounded shadow text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    برگشت به صفحه قبل
                </router-link>
            </div>
            <div>
                <h1 class="font-bold text-xl">&nbsp;</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <!-- display message area -->
                <div class="bg-green-700 text-white rounded py-4 text-center" v-if="departmentStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="departmentStore.msg_success = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ departmentStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-red-500 text-white py-4 rounded text-center" v-if="departmentStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="departmentStore.msg_wrang = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ departmentStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->
                <div>
                    <div class="border-b py-2">
                        <h1 class="font-bold text-xl ">فورم ثبت اطلاعات دیپارتمنت </h1>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="md:flex items-center justify-center">
                        <div class="w-2/12">
                            <label class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4">نام دیپارتمنت
                                <span class="text-red-500 px-2">*</span>
                            </label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="text" v-model="department.name" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex items-center justify-center">
                        <div class="w-2/12">
                            <label class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4">تاریخ تأسیس<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="md:w-6/12">
                            <CustomInput type="date" v-model="department.date" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex items-center justify-center">
                        <div class="md:w-2/12 md:items-center">
                            <label class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4">توضیحات<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="md:w-6/12">
                            <CustomInput type="textarea" v-model="department.description" class="mb-2" />
                        </div>
                    </div>

                </div>
            </div>
            <footer class="bg-gray-100 py-4  md:flex gap-5">
                <button type="submit"
                    :class="[departmentStore.loading === true ? 'bg-green-600 mr-10 text-white py-2 px-6 cursor-not-allowed rounded focus:ring focus:ring-green-500' : 'bg-green-600 mr-10 text-white py-2 px-6 cursor-pointer rounded focus:ring focus:ring-green-500']">
                    <span v-if="departmentStore.loading === true">
                        <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                    <span v-else>
                        ثبت
                    </span>

                </button>
                <router-link :to="{ name: 'app.faculty.details', params: { id: $route.params.id } }" class=" bg-gray-400 text-white py-2 px-5 cursor-pointer rounded focus:ring
                    focus:ring-gray-300">لغو
                    ثبت</router-link>
            </footer>
        </form>

    </div>
</template>

<script setup>
import { computed, ref, useSlots } from 'vue'
import { useRoute } from 'vue-router';
import CustomInput from '../../components/core/CustomInput.vue'
import { useDepartmentStore } from '../../stores/department/deparmentStore'

const departmentStore = useDepartmentStore();
const route = useRoute();

const department = computed(() => departmentStore.department);



function onSubmit() {
    let id = route.params.id;
    departmentStore.createDepartment(department.value, id);
    department.value.date = ''
    department.value.description = ''
    department.value.name = ''
}

</script>
