<template>
    <div class="min-w-full mt-6">
        <div>
            <h1 class="text-3xl font-bold mb-7 text-gray-700">داشبورد</h1>
        </div>
        <div v-if="msg_welcome"
            class="min-w-96 items-center flex justify-between gap-4 mb-4 bg-indigo-300  font-bold  py-2 rounded px-8">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" @click="msg_welcome = false" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-8 h-8 cursor-pointer  hover:bg-gray-100 rounded-full shadow">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

            </div>

            <!-- <div>
                    <DropZone />
                </div> -->


            <div>
                <h1 class="text-3xl">به داشبورد سیستم خوش آمدید {{ authStore.user.data.name }}</h1>
            </div>
            <div>
                <img src="../../public/pencil-revision.svg" class="w-20" alt="">
            </div>
        </div>


    </div>
</template>
<script setup>
// import DropZone from '../views/dropzone.vue'


import { computed, onMounted, ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { useUserStore } from '../stores/user/userStore';

const authStore = useAuthStore();
const userStore = useUserStore();
const admin = computed(() => userStore.permission_current.admin)


onMounted(() => {
    getUser();
    getCurrentPermission();

})

function getUser() {
    authStore.getUser();

}


function getCurrentPermission() {
    userStore.getCurrentPermission();
}


let msg_welcome = ref(true);


</script>
