import { defineStore } from 'pinia'
import router from '../../routes'
import axiosClient from '../../axios'
import { ref } from 'vue';

export const useDepartmentStore = defineStore('department', () => {

    let msg_success = ref('');
    let msg_wrang = ref('');
    let loading = ref(false);

    let Departments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let TeacherDepartments = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let department = ref({
        id: '',
        name: '',
        date: '',
        description: '',
    });


    // actions
    function createDepartment(data, id) {
        loading.value = true
        axiosClient.post(`/faculty/department/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            });
    }

    function getDepartments({ url = null, per_page, search = '', sortDirection, sortField } = {}) {
        Departments.value.loading = true;
        url = url || '/faculty'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Departments.value.loading = false
            setFaculty(response.data);
        }).catch((err) => {
            Departments.value.loading = false
            console.log(err);
        })
    }


    function getTeacherDepartments({ url = null, per_page, search = '', id } = {}) {
        Departments.value.loading = true;
        url = url || '/teacher/department'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                search,
                per_page,
                id
            }
        }).then((response) => {
            console.log(response);
            TeacherDepartments.value.loading = false
            setTeacherDepartment(response.data);
        }).catch((err) => {
            TeacherDepartments.value.loading = false
            console.log(err);
        })
    }


    function setTeacherDepartment(data) {
        if (data) {
            TeacherDepartments.value.data = data.data;
            TeacherDepartments.value.links = data.meta?.links;
            TeacherDepartments.value.to = data.meta.to;
            TeacherDepartments.value.from = data.meta.from;
            TeacherDepartments.value.current_page = data.meta.current_page;
            TeacherDepartments.value.total = data.meta.total;
        }
    }


    function getDepartment(id) {
        axiosClient.get(`department/details/${id}`)
            .then(({ data }) => {
                department.value = data
            }).catch((err) => {
                console.log(err);
            })
    }

    function editDepartment(data) {
        loading.value = true
        axiosClient.post('/department/update', data)
            .then((response) => {
                loading.value = false
                msg_success.value = response.data.message
            }).catch((error) => {
                loading.value = false
                msg_wrang.value = error.response.data.message
            })

    }



    function deleteDepartment(id) {
        loading.value = true
        axiosClient.get(`/department/delete/${id}`)
            .then((response) => {
                if (response.status == 200) {
                    msg_success.value = 'درخواست حذف موافقانه انجام شد'
                }
            }).catch((error) => {
                msg_wrang.value = '.درخواست موفقانه انجام نشد'
            })
    }


    return {

        getDepartment,
        getDepartments,
        getTeacherDepartments,
        TeacherDepartments,
        createDepartment,
        editDepartment,
        deleteDepartment,
        Departments,
        department,
        loading,
        msg_success,
        msg_wrang,
    }

})
