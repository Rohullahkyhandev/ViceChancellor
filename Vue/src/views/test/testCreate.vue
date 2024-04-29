<template>
  <div class="mt-10 mb-10 w-full">
    <div class="flex items-center justify-between w-full">
      <div>
        <router-link
          :to="{ name: 'app.student.list' }"
          class="bg-blue-600 flex items-center justify-center gap-3 focus:ring focus:ring-blue-500 focus:ring-offset-2 py-2 px-6 rounded-lg shadow text-white"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
            />
          </svg>

          لیست محصلین
        </router-link>
      </div>
      <div>
        <h1 class="font-bold text-xl">فورم ثبت اطلاعات محصلین</h1>
      </div>
    </div>

    <form @submit.prevent="onSubmit">
      <div class="w-full py-8 bg-white shadow mt-8 px-4">
        <!-- display message area -->
        <div
          class="bg-green-700 text-white rounded py-4 text-center"
          v-if="studentStore.msg_success"
        >
          <div class="flex items-center justify-between px-10">
            <div
              class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                @click="studentStore.msg_success = ''"
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
              <span>{{ studentStore.msg_success }}</span>
            </div>
          </div>
        </div>

        <div
          class="bg-red-500 text-white py-4 rounded text-center"
          v-if="studentStore.msg_wrang"
        >
          <div class="flex items-center justify-between px-10">
            <div
              class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                @click="studentStore.msg_wrang = ''"
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
              <span>{{ studentStore.msg_wrang }}</span>
            </div>
          </div>
        </div>
        <!-- end of display message area -->

        <div class="mt-5">
          <div class="md:flex md:items-center md:justify-center">
            <div class="md:w-2/12">
              <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
                >نام
                <span class="text-red-500 px-4">*</span>
              </label>
            </div>
            <div class="md:w-6/12">
              <CustomInput
                type="text"
                v-model="test.name"
                class="mb-2"
                required="required"
                label="نام"
              />
            </div>
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >تخلص
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="text"
              v-model="test.st_id"
              class="mb-2"
              required="required"
              label="تخلص"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >نام پدر
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12">
            <CustomInput
              type="text"
              v-model="student.fname"
              class="mb-2"
              required="required"
              label="نام پدر"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >ایمل آدرس
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12">
            <CustomInput
              type="text"
              v-model="student.email"
              class="mb-2"
              required="required"
              label="ایمل آدرس"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >شماره تماس
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12">
            <CustomInput
              type="text"
              v-model="student.phone"
              class="mb-2"
              required="required"
              label="شماره تماس "
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >جنسیت
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12 mb-2">
            <div class="flex items-center justify-start gap-7">
              <div class="flex items-center justify-start gap-4">
                <b> مرد</b>
                <input
                  type="radio"
                  name="gander"
                  checked
                  class="rounded-full focus:ring focus:bg-indigo-500"
                  v-model="student.gender"
                  value="مرد"
                />
              </div>
              <div class="flex items-center justify-start gap-4">
                <b> زن</b>
                <input
                  type="radio"
                  name="gander"
                  v-model="student.gender"
                  class="rounded-full focus:ring focus:bg-indigo-500"
                  value="زن"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >آی دی کانکور
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="text"
              v-model="student.kankor_id"
              class="mb-2"
              required="required"
              label="آی دی کانکور"
            />
          </div>
        </div>
        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >نمره کانکور
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="text"
              v-model="student.kankor_mark"
              class="mb-2"
              required="required"
              label="نمره کانکور"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >ریشته درو لیسانس
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="text"
              v-model="student.bachelor_field"
              class="mb-2"
              required="required"
              label="ریشته درو لیسانس"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >تاریخ ثبت نام
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <!-- <EMDatePicker v-model="teacher.hire_date" /> -->
            <CustomInput
              type="date"
              v-model="student.admission_date"
              class="mb-2"
              required="required"
              label=" تاریخ ثبت نا"
            />
            <!-- <persianDateTime /> -->
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >گررپ خون
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <!-- <EMDatePicker v-model="teacher.hire_date" /> -->
            <CustomInput
              type="text"
              v-model="student.blood_group"
              class="mb-2"
              required="required"
              label=" گررپ خون "
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >آدرس
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="textarea"
              v-model="student.address"
              class="mb-2"
              required="required"
              label="آدرس "
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >نمبر تذکره
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <!-- <EMDatePicker v-model="teacher.hire_date" /> -->
            <CustomInput
              type="text"
              v-model="student.nic"
              class="mb-2"
              required="required"
              label="نمبر تذکره"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >فاکولته
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="md:w-6/12">
            <CustomInput
              type="select"
              @change="getFaculty(student.faculty_id)"
              :selectOptions="faculties"
              v-model="student.faculty_id"
              class="mb-2"
              required="required"
              label="فاکولته"
            />
          </div>
        </div>

        <div
          class="md:flex md:items-center md:justify-center"
          v-if="departments.length != ''"
        >
          <div class="w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >دیپارتمنت
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12">
            <CustomInput
              type="select"
              :selectOptions="departments"
              v-model="student.department_id"
              class="mb-2"
              required="required"
              label="دیپارتمنت"
            />
          </div>
        </div>

        <div class="md:flex md:items-center md:justify-center">
          <div class="md:w-2/12">
            <label class="block text-gray-500 md:text-left mb-1 md:mb-0"
              >فوتو
              <span class="text-red-500 px-4">*</span>
            </label>
          </div>
          <div class="w-6/12">
            <CustomInput
              type="file"
              @change="(file) => (student.photo = file)"
              class="mb-2"
              required="required"
              label="فوتو"
            />
          </div>
        </div>
      </div>
      <footer class="bg-gray-100 py-4 md:flex gap-5">
        <button
          type="submit"
          :disabled="studentStore.loading"
          :class="[
            studentStore.loading === true
              ? 'bg-indigo-600 mr-10 text-white py-2 px-6 cursor-not-allowed rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500'
              : 'bg-indigo-600 mr-10 text-white py-2 px-6 cursor-pointer rounded-lg focus:ring focus:ring-offset-2 focus:ring-indigo-500',
          ]"
        >
          <span v-if="studentStore.loading === true">
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
// import persianDateTime from '../../components/core/CustomeDateTime.vue'
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../components/core/CustomInput.vue";
import { useTestStore } from "../../stores/test/testStore";

const route = useRoute();

const testStore = useTestStore();

const test = computed(() => testStore.test);

function onSubmit(test) {
  testStore.createStudent();
}

onMounted(() => {
  teacherStore.getFaculties();
  if (student.value.faculty_id != "") {
    teacherStore.getDepartments(student.value.faculty_id);
  }
});

const departments = computed(() =>
  teacherStore.departments.map((c) => ({
    key: c.department_id,
    text: c.department_name,
  }))
);
const faculties = computed(() =>
  teacherStore.faculties.map((c) => ({ key: c.faculty_id, text: c.fname }))
);

function getFaculty(id) {
  teacherStore.getDepartments(id);
}

function onSubmit() {
  let id = route.params.id;

  if (student.value.faculty_id != "") {
    studentStore.createStudent(student.value);
    // studentStore.student.name = ''
    // studentStore.student.lname = '',
    //     studentStore.student.fname = '',
    //     studentStore.student.phone = '',
    //     studentStore.student.email = '',
    //     studentStore.student.kankor_id = '',
    //     studentStore.student.kankor_mark = '',
    //     studentStore.student.bachelor_field = '',
    //     studentStore.student.status = '',
    //     studentStore.student.nic = '',
    //     studentStore.student.address = '',
    //     studentStore.student.admission_year = '',
    //     studentStore.student.blood_group = '',
    //     studentStore.student.faculty_id = '',
    //     studentStore.student.faculty_id = '',
    //     studentStore.student.department_id = ''
  }
}
</script>
