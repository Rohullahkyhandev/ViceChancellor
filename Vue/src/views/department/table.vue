<template>
  <div class="mt-10">
    <div
      class="bg-white p-6 rounded-lg shadow animate-fade-in-down overflow-auto"
    >
      <!-- display message area -->
      <div
        class="bg-green-500 text-white rounded py-4 text-center mb-3"
        v-if="departmentStore.msg_success"
      >
        <div class="flex items-center justify-between px-10">
          <div
            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              @click="departmentStore.msg_success = ''"
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
            <span>{{ departmentStore.msg_success }}</span>
          </div>
        </div>
      </div>

      <div
        class="bg-red-500 text-white py-4 rounded text-center mb-3"
        v-if="departmentStore.msg_wrang"
      >
        <div class="flex items-center justify-between px-10">
          <div
            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              @click="departmentStore.msg_wrang = ''"
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
            <span>{{ departmentStore.msg_wrang }}</span>
          </div>
        </div>
      </div>
      <!-- end of display message area -->
      <!-- <table class="table-auto w-full mb-4">
                <thead>
                    <tr>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b-1 border-gray-700 border-t-1  p-2 bg-gray-200 mb-4   text-center">
                            &nbsp;&nbsp;<b> دیپارمنت های این
                                فاکولته&nbsp;&nbsp;
                            </b>
                        </td>
                        <br>
                    </tr>
                </tbody>

                <tbody>
                    <tr>

                    </tr>
                </tbody>

            </table> -->
      <div class="flex justify-between border-b-2 pb-3">
        <div>
          <input
            v-model="search"
            @change="getTeacherDepartments(null)"
            class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="جستجوی بر اساس نام"
          />
        </div>
        <div class="flex items-center">
          <span class="whitespace-nowrap mr-3">هر صفحه</span>
          &nbsp;
          <select
            dir="ltr"
            @change="getTeacherDepartments(null)"
            v-model="perPage"
            class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          >
            <option value="5" selected>5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          &nbsp;
          <span class="ml-3">پیداشد {{ teacher_departments.total }} دیتا</span>
        </div>
      </div>
      <table class="table-auto w-full">
        <thead>
          <tr>
            <TableHeaderCell
              field="id"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              شماره.
            </TableHeaderCell>

            <TableHeaderCell
              field="name"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('name')"
            >
              دیپارتمنت
            </TableHeaderCell>

            <TableHeaderCell
              field="email"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              نام
            </TableHeaderCell>

            <TableHeaderCell
              field="email"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              تخلص
            </TableHeaderCell>

            <TableHeaderCell
              field="email"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              آدرس ایمل
            </TableHeaderCell>

            <TableHeaderCell
              field="email"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              رتبه علمی
            </TableHeaderCell>

            <TableHeaderCell
              field="id"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('id')"
            >
              کابر
            </TableHeaderCell>

            <TableHeaderCell
              field="action"
              :sortDirection="sortDirection"
              :sortField="sortField"
              @click="sortUsers('acs')"
            >
              عملیات
            </TableHeaderCell>
          </tr>
        </thead>
        <tbody
          v-if="
            teacher_departments.loading || !teacher_departments.data?.length
          "
        >
          <tr>
            <td colspan="7">
              <Spinner v-if="teacher_departments.loading" />
              <p v-else class="text-center py-8 text-gray-700">
                نتیجه ای پیدا نشد
              </p>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr v-for="(teacher_department, index) of teacher_departments.data">
            <td class="border-b p-2">{{ index + 1 }}</td>

            <td class="border-b p-2">
              {{ teacher_department.name }}
            </td>
            <td class="border-b p-2">
              {{ teacher_department.tname }}
            </td>
            <td class="border-b p-2">
              {{ teacher_department.lname }}
            </td>

            <td class="border-b p-2">
              {{ teacher_department.temail }}
            </td>

            <td class="border-b p-2">
              {{ teacher_department.arank }}
            </td>

            <td class="border-b p-2">
              <img
                :src="teacher_department.photo"
                class="object-fill w-16"
                :alt="teacher_department.tname"
              />
            </td>

            <td class="border-b p-2">
              <Menu as="div" class="relative inline-block text-left">
                <div>
                  <MenuButton
                    class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-blue-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                  >
                    <svg
                      class="text-red"
                      xmlns="http://www.w3.org/2000/svg"
                      width="20"
                      height="20"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill="currentColor"
                        d="M10 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Z"
                      />
                    </svg>
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition duration-100 ease-out"
                  enter-from-class="transform scale-95 opacity-0"
                  enter-to-class="transform scale-100 opacity-100"
                  leave-active-class="transition duration-75 ease-in"
                  leave-from-class="transform scale-100 opacity-100"
                  leave-to-class="transform scale-95 opacity-0"
                >
                  <MenuItems
                    class="absolute z-10 left-4 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  >
                    <div class="px-1 py-1"></div>

                    <!-- <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                            <button @click="deleteDepartment(teacher_department.id)" :class="[
                                                active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                            ]">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                                حذف
                                            </button>
                                            </MenuItem>
                                        </div> -->
                  </MenuItems>
                </transition>
              </Menu>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        v-if="!teacher_departments.loading"
        class="flex justify-between items-center mt-5"
        dir="ltr"
      >
        <div v-if="teacher_departments.data">
          نمایش از {{ teacher_departments.from }} تا
          {{ teacher_departments.to }}
        </div>
        <nav
          v-if="teacher_departments.total > teacher_departments.limit"
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a
            v-for="(link, i) of teacher_departments.links"
            :key="i"
            :d
            isabled="!link.url"
            href="#"
            @click="getForPage($event, link)"
            aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
            :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-md' : '',
              i === teacher_departments.links.length - 1 ? 'rounded-r-md' : '',
              !link.url ? ' bg-gray-100 text-gray-700' : '',
            ]"
            v-html="link.label"
          >
          </a>
        </nav>
      </div>
    </div>
    <br /><br />
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../constant";
import TableHeaderCell from "../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute } from "vue-router";
import { useDepartmentStore } from "../../stores/department/deparmentStore";

const departmentStore = useDepartmentStore();
const route = useRoute();

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const teacher_departments = computed(() => departmentStore.TeacherDepartments);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

// let msg_success = ref(computed(() => store.state.msg_success));
// let msg_warning = ref("");
// let user_image_src = '';

onMounted(() => {
  getTeacherDepartments();
});

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }
  getTeacherDepartments(link.url);
}

function getTeacherDepartments(url = null) {
  departmentStore.getTeacherDepartments({
    url,
    id: route.params.id,
    search: search.value,
    per_page: perPage.value,
  });
}

function sortUsers(field) {
  if (field === sortField.value) {
    if (sortDirection.value === "desc") {
      sortDirection.value = "asc";
    } else {
      sortDirection.value = "desc";
    }
  } else {
    sortField.value = field;
    sortDirection.value = "asc";
  }
  getTeacherDepartments();
}

function deleteDepartment(id) {
  if (!confirm(`Are you sure you want to delete the product?`)) {
    return;
  }
  // departmentStore.deleteDepartment(id);
  getTeacherDepartments();
}

function msg_success_fun() {}
function msg_warning_fun() {}
</script>

<style scoped></style>
