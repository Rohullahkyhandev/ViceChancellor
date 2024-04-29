<template>
    <div class="w-full shadow-lg h-14 bg-white relative flex items-center justify-center">
        <div class="absolute  left-4 w-56 text-right">
            <Menu as="div" class="relative inline-block text-left w-full">
                <div class="h-14 hover:bg-gray-100 transition-colors py-2 px-3 w-full">
                    <MenuButton>
                        <div class="flex items-center justify-between w-full gap-5"
                            @click="rotateProfile = !rotateProfile">
                            <span v-if="auth.user.data.photo_path != ''">
                                <img :src="auth.user.data.photo_path" class="rounded-full  object-cover h-10 w-10"
                                    :alt="auth.user.data.name">
                            </span>
                            <span v-else>
                                <img src="../../public/th.jpg" class="rounded-full  object-cover h-10 w-10">
                            </span>
                            <span>{{ auth.user.data.name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                :class="[rotateProfile == true ? 'rotate-180 w-5 h-5 transition' : 'w-5 h-5 transition']">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                    </MenuButton>
                </div>
                <transition enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                        class="absolute right-0 mt-2 w-56 origin-top-right   rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                            <button :class="[
                                active ? 'bg-red-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]" @click="logout">
                                <EditIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                خروج
                            </button>

                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                            <router-link :to="{ name: 'app.user.list' }" :class="[
                                active ? 'bg-blue-500 text-white' : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]">
                                <DuplicateIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                پروفایل کاربر
                            </router-link>
                            </MenuItem>
                        </div>
                    </MenuItems>
                </transition>
            </Menu>
        </div>

        <div class="flex items-center justify-center  mr-60">
            <Menu as="div" class="relative inline-block text-left w-full">
                <div class="h-14 hover:bg-gray-100 transition-colors  py-3 px-3 w-full">
                    <MenuButton>
                        <div class="flex items-center justify-between w-full relative"
                            @click="notification_box = !notification_box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                            </svg>
                            <span
                                class="w-4 h-4 mb-3 bg-blue-500 rounded-full flex  items-center justify-center text-white py-3 px-3">{{
                                counter }}</span>
                        </div>
                    </MenuButton>
                </div>
                <transi enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                        class="absolute right-0 mt-2 w-80 origin-top-right    bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                        <div class="px-1 py-1">

                            <MenuItem v-slot="{ active }">
                            <router-link to=""
                                :class="[active ? 'bg-gray-100 group flex w-full items-center  px-2  py-2 text-sm' : 'group flex w-full items-center  px-2 py-2 text-sm']">
                                <DuplicateIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 bg-red-500 rounded-full text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                ‌ {{ message }}
                            </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1">

                            <MenuItem v-slot="{ active }">
                            <router-link to=""
                                :class="[active ? 'bg-gray-100 group flex w-full items-center  px-2  py-2 text-sm' : 'group flex w-full items-center  px-2 py-2 text-sm']">
                                <DuplicateIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 bg-red-500 rounded-full text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                ‌ {{ message }}
                            </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1">

                            <MenuItem v-slot="{ active }">
                            <router-link to=""
                                :class="[active ? 'bg-gray-100 group flex w-full items-center  px-2  py-2 text-sm' : 'group flex w-full items-center  px-2 py-2 text-sm']">
                                <DuplicateIcon :active="active" class="mr-2 h-5 w-5 text-violet-400"
                                    aria-hidden="true" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 bg-red-500 rounded-full text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                ‌ {{ message }}
                            </router-link>
                            </MenuItem>
                        </div>

                    </MenuItems>
                </transi tion>
            </Menu>

        </div>



    </div>
</template>


<script setup>
import { Menu, MenuItem, MenuItems, MenuButton } from '@headlessui/vue'
import { computed, onMounted, ref } from "vue";
import { useRouter } from 'vue-router';
import { useAuthStore } from "../stores/auth";
const rotateProfile = ref(false);
const notification_box = ref(false);
const router = useRouter();
const auth = useAuthStore();
onMounted(() => {
    auth.getUser();
})
function logout() {
    auth.logout();
    router.push({ name: 'login' })
}


// testing real-time showing message or notification with using sample way of js code with setInterval

let message = ref("Draft Document is pending for approve")
let counter = ref(3);
function displayNotification() {

}

const updateNotification = setInterval(() => {
    displayNotification()
}, 5000);




</script>
