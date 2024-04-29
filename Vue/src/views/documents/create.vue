<template>
  <div class="mt-4 mb-4">
    <form @submit.prevent="onSubmit">
      <div class="py-8 bg-white shadow mt-8 px-4">
        <!-- display message area -->
        <div
          class="bg-green-700 text-white rounded py-4 text-center"
          v-if="documentStore.msg_success"
        >
          <div class="flex items-center justify-between px-10">
            <div
              class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                @click="documentStore.msg_success = ''"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18 18 6M6 6l12 12"
                />
              </svg>
            </div>
            <div>
              <span>{{ documentStore.msg_success }}</span>
            </div>
          </div>
        </div>

        <div
          class="bg-red-500 text-white py-4 rounded text-center"
          style="width: inherit !important"
          v-if="documentStore.msg_wrang"
        >
          <div class="flex items-center justify-between px-10">
            <div
              class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                @click="documentStore.msg_wrang = ''"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18 18 6M6 6l12 12"
                />
              </svg>
            </div>
            <div>
              <span>{{ documentStore.msg_wrang }}</span>
            </div>
          </div>
        </div>
        <!-- end of display message area -->

        <div class="mt-5">
          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for="number"
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                شماره مکتوب<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="text"
                id="number"
                v-model="document.number"
                class="mb-2"
                required="required"
              />
            </div>
          </div>

          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
                >مبتدا مکتوب<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="text"
                v-model="document.source"
                class="mb-2"
                required="required"
              />
            </div>
          </div>

          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                مرجع مکتوب<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="text"
                v-model="document.destination"
                class="mb-2"
                required="required"
              />
            </div>
          </div>

          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                نوع مکتوب<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="select"
                :select-options="document_type"
                v-model="document.type"
                class="mb-2"
                required="required"
                label=" نوع مکتوب"
              />
            </div>
          </div>

          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                خلاصه مطلب<span class="text-red-500 px-2"></span
              ></label>
            </div>
            <div class="w-6/12">
              <CustomInput
                type="textarea"
                v-model="document.description"
                class="mb-2"
                required="required"
              />
            </div>
          </div>

          <div class="md:flex md:items-center">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                ملاحضات<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="textarea"
                v-model="document.remark"
                class="mb-2"
                required="required"
              />
            </div>
          </div>

          <div class="md:flex md:items-center w-full">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                تاریخ<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <date-picker
                v-model="document.date"
                placeholder="لطفا تاریخ را انتخاب نماید"
                class="mb-2 block w-full px-3 py-1.5 border rounded-md shadow border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              ></date-picker>
            </div>
          </div>

          <div class="md:flex md:items-center w-full">
            <div class="w-2/12">
              <label
                for=""
                class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >
                اسکن مکتوب<span class="text-red-500 px-2">*</span></label
              >
            </div>
            <div class="w-6/12">
              <CustomInput
                type="file"
                class="mb-2"
                @change="(file) => (document.attachment = file)"
              />
            </div>
          </div>
        </div>
      </div>
      <footer class="bg-gray-100 py-4 md:flex gap-5">
        <button
          type="submit"
          :disabled="documentStore.loading"
          :class="[
            documentStore.loading === true
              ? 'bg-indigo-400 mr-10 text-white py-2 px-6 cursor-not-allowed rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500'
              : 'bg-indigo-600 mr-10 text-white py-2 px-6 cursor-pointer rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500',
          ]"
        >
          <span v-if="documentStore.loading === true">
            <svg
              class="animate-spin -ml-1 h-5 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
              ></circle>
              <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
          </span>
          <span v-else> ثبت </span>
        </button>
        <router-link
          :to="{ name: 'app.teacher.list' }"
          class="bg-white shadow py-2 px-5 cursor-pointer rounded-lg focus:ring focus:ring-offset-2 focus:ring-red-400"
          >لغو ثبت</router-link
        >
      </footer>
    </form>
  </div>
</template>
<script setup>
import DatePicker from "vue3-persian-datetime-picker";
import CustomInput from "../../components/core/CustomInput.vue";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { computed, ref } from "vue";
import { useDocumentStore } from "../../stores/documents/DocumentStore";
const documentStore = useDocumentStore();

const document = computed(() => documentStore.document);

const document_type = ref([
  {
    key: "sent document",
    text: "مکتوب صادره",
  },

  {
    key: "received document",
    text: "مکتوب وارده",
  },
]);

function onSubmit() {
  documentStore.createDocument(document.value);
}
</script>
