<template>
    <div class="w-full h-full flex flex-col  mt-40 gap-6 items-center justify-center">

        <div v-if="authStore.msg_wrang"
            class="bg-red-500 rounded overflow-hidden   shadow text-white py-3 px-4 flex items-center justify-between gap-9">
            {{ authStore.msg_wrang }}
            <svg @click="authStore.msg_wrang = ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-8 h-8 cursor-pointer  hover:bg-red-400 rounded-full shadow">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="rounded shadow border flex items-center  justify-center gap-10">

            <div class="">
                <div
                    class="w-80 h-80 px-4 py-5 bg-blue-500 flex   flex-col items-center rounded-tr-full shadow-lg rounded-br-full rounded-tl-lg rounded-bl-lg">
                    <div class="mt-6">
                        <img src="../../public/logo.PNG" width="100px" alt="K.P.U LOGO">
                    </div>
                    <div class="mt-5">
                        <p class="flex items-center justify-center text-center text-white font-semibold">
                            به سیستم مدیریت معاونیت علمی پوهنتون پولی تخنیک کابل خوش آمدید
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-10">
                <h1 class="text-3xl font-semibold text-gray-700 mb-6 text-center"
                    style="font-family:Arial, Helvetica, sans-serif;">با حساب خود وارد شود</h1>
                <form @submit.prevent="onSubmit">
                    <div class="w-full mb-3">
                        <div class=" md:w-10/12">
                            <input type="email" v-model="user.email" dir="rtl" placeholder="آدرس ایمل"
                                class="w-80 shadow focus:ring-indigo-500 focus:border-indigo-500  rounded-t border-gray-100">
                        </div>
                        <div class="mb-3">
                            <input type="password" v-model="user.password" dir="rtl" placeholder="رمز عبور "
                                class="w-80 shadow focus:ring-indigo-500 focus:border-indigo-500 rounded-b border-gray-100">
                        </div>
                        <div class="md:w-12/12 flex items-center justify-between gap-2">
                            <button type="submit" :disabled="authStore.loading"
                                :class="[authStore.loading == true ? 'bg-blue-400 w-80 text-white flex  cursor-not-allowed rounded shadow px-3 py-2 items-center justify-between' : 'bg-blue-600 w-80 text-white flex  rounded shadow px-3 py-2 items-center justify-between']">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                                <div class="flex items-center justify-center gap-4">
                                    <span>
                                        ورد به سیستم
                                    </span>
                                    <span v-if="authStore.loading">
                                        <svg class="animate-spin -ml-1 h-5 w-5 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <c ircle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></c>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 1
2h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </span>
                                </div v>

                                <span>
                                    &nbsp;
                                </span>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import router from "../routes";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();



let user = ref({
    email: '',
    password: '',
})

function onSubmit() {
    authStore.login(user.value);
}


</script>
