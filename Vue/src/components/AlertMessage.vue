<template>
    <main>

        <template v-if="msg_success">
            <div class="w-full py-6 overflow-hidden  text-white text-center bg-red-500 border-b-8 border-red-300"
                v-if="durationDiplay">
                <div class="flex items-center justify-around">
                    <div
                        class=" cursor-pointer w-10 h-10 rounded-full hover:bg-red-200 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="msg_wrang = ''" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span>{{ props.msg_success }}</span>
                    </div>
                    <div>
                        &nbsp;
                    </div>
                </div>
            </div>
        </template>
        <template v-if="msg_wrang">
            <div class="w-full py-6 overflow-hidden  text-white text-center bg-red-500 border-b-8 border-red-300"
                v-if="durationDiplay">
                <div class="flex items-center justify-around">
                    <div
                        class=" cursor-pointer w-10 h-10 rounded-full hover:bg-red-200 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="msg_wrang = ''" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span>{{ msg_wrang }}</span>
                    </div>
                    <div>
                        &nbsp;
                    </div>
                </div>
            </div>
        </template>
    </main>
</template>

<script setup>
import { ref } from 'vue';
const durationDiplay = ref(true);
const props = defineProps({
    msg_success: String,
    msg_wrang: String
})

setTimeout(() => {
    durationDiplay.value = false
}, 10000)


</script>
