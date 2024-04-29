<template>
    <div class="mt-10 mb-10 w-full">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link :to="{ name: 'app.user.list' }" class="btn-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    لیست کابران
                </router-link>

            </div>
            <div>
                <h1 class="font-bold text-xl">فورم راجستر کابر</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <div class="bg-green-700 text-white rounded py-3 text-center" v-if="userStore.msg_success">
                    <div>
                        <div>
                            <span>{{ userStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-red-500 text-white py-3 rounded text-center" v-if="userStore.msg_wrang">
                    <div>
                        <div>
                            <span>{{ userStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">نام کامل کابر<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="text" v-model="user.name" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">آدرس ایمل<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="text" v-model="user.email" class="mb-2" required="required" />
                        </div>
                    </div>


                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class=" block text-gray-500 md:text-left mb-1 md:mb-0">جایگاه کاری<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="text" v-model="user.position" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">بخش مربوط<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="select" v-model="user.user_type" :select-options="user_type" class="mb-2"
                                label="بخش مربوط" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">رمز عبور<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="password" v-model="user.password" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">تا‌ید رمز عبور<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="password" v-model="user.password_confirmation" class="mb-2"
                                required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">عکس<span
                                    class="text-red-500 px-2"></span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="file" class="mb-2" @change="file => user.photo = file" />
                        </div>
                    </div>

                </div>
            </div>
            <footer class="bg-gray-100 py-4  md:flex gap-5">
                <button type="submit" class="footer-btn-indigo">ثبت</button>
                <router-link :to="{ name: 'app.dashboard' }" class="footer-btn-red">لغو
                    ثبت</router-link>
            </footer>
        </form>

    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from 'vue'
import CustomInput from '../../components/core/CustomInput.vue'
import { useUserStore } from '../../stores/user/userStore';


onMounted(() => {
    userStore.getUserDepartment();
})

const userStore = useUserStore();

// const user_type = ref([
//     { key: 'pdc', text: 'PDC' },
//     { key: 'آمریت استادان', text: 'آمریت استادان' },
//     { key: 'آمریت فوق لیسانس', text: 'آمریت فوق لیسانس' },
//     { key: 'آمریت تضمین کیفت', text: 'آمریت تضمین کیفت' },
//     { key: 'آمریت  تحقیقات علمی', text: 'آمریت  تحقیقات علمی' },
// ])

const user_type = computed(() => userStore.user_departments.map((c) => ({ key: c.id, text: c.display_name })))

const user = ref({
    name: '',
    email: '',
    user_type: '',
    position: '',
    password: '',
    password_confirmation: '',
    photo: ''
})


function onSubmit() {
    userStore.createUser(user.value);
}

</script>
