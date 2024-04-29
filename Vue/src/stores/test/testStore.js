import { defineStore } from 'pinia'
import axiosClient from '../../axios'
import { ref } from 'vue';


export const useTestStore = defineStore('test', () => {

    let loading = ref(false);
    let msg_success = ref(false);
    let msg_wrang = ref(false);
    let Tests = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    const test = ref({
        name: "",
        st_id: "",
        phone: ""
    })



    function createTestStudent(data) {
        loading.value = true
        const formdata = new FormData();

        const student_photo = ''
        if (student_photo instanceof File) {
            student_photo = data.photo;
        }

        formdata.append("name", data.name);
        formdata.append("st_id", data.st_id);
        formdata.append("phone", data.phone);
        data = formdata;

        axiosClient.post("/test_student/create", data)
            .then((res) => {
                loading.value = false
                msg_success = res.data.message;
            }).catch((error) => {
                msg_wrang.value = error.response.data.message;
            })
    }


    // let student = ref({
    //     name: '',
    //     lname: '',
    //     fname: '',
    //     phone: '',
    //     email: '',
    //     gender: '',
    //     kankor_id: '',
    //     kankor_mark: '',
    //     bachelor_field: '',
    //     nic: '',
    //     address: '',
    //     admission_date: '',
    //     blood_group: '',
    //     faculty_id: '',
    //     department_id: '',
    // });


    // let student_details = ref({
    //     name: '',
    //     lname: '',
    //     fname: '',
    //     phone: '',
    //     email: '',
    //     gender: '',
    //     kankor_id: '',
    //     kankor_mark: '',
    //     bachelor_field: '',
    //     nic: '',
    //     address: '',
    //     admission_date: '',
    //     blood_group: '',
    //     faculty: '',
    //     department: '',
    //     photo_path: ''
    // });


    // create student
    function createStudent(data) {
        loading.value = true
        let photo = ''
        if (data.photo instanceof File) {
            photo = data.photo
        } else {
            data.photo = ''
        }
        var form = new FormData();
        form.append('name', data.name)
        form.append('lname', data.lname)
        form.append('fname', data.fname)
        form.append('email', data.email)
        form.append('phone', data.phone)
        form.append('address', data.address)
        form.append('kankor_id', data.kankor_id)
        form.append('kankor_mark', data.kankor_mark)
        form.append('admission_date', data.admission_date)
        form.append('bachelor_field', data.bachelor_field)
        form.append('gender', data.gender)
        form.append('nic', data.nic)
        form.append('blood_group', data.blood_group)
        form.append('faculty_id', data.faculty_id)
        form.append('department_id', data.department_id)
        form.append('photo', photo)

        data = form

        axiosClient.post('/student/create', data)
            .then((response) => {
                console.log(response);
                loading.value = false
                student.value = ''
                msg_success.value = response.data.message;
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            })

    }

    // show students

    function getTestSudents({ url = null, search, sortField, sortDirection, per_page } = {}) {
        Students.value.loading = true
        url = url || '/student'
        const params = {
            per_page: 10
        }

        axiosClient.get(url, {
            params: {
                ...params,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((data) => {
            console.log(data.data);
            Students.value.loading = false
            setStudent(data.data);

        }).catch((err) => {
            console.log(err);
            Students.value.loading = false
        })


    }


    // setStudent
    function setStudent(data) {
        if (data) {
            Students.value.data = data.data;
            Students.value.links = data.meta?.links;
            Students.value.from = data.meta.from;
            Students.value.to = data.meta.to;
            Students.value.total = data.meta.total;
            Students.value.per_page = data.meta.current_page;
            Students.value.limit = data.meta.per_page;
        }
    }


    // student details

    function getStudentDetails(id) {
        axiosClient.get(`/student/details/${id}`)
            .then(({ data }) => {
                student_details.value = data;
            }).catch((error) => {
                console.log(error)
            })
    }

    // edit student
    function editStudent(id) {

    }

    // update student
    function updateStudent(id, data) {

    }

    // delete student

    function deleteStudent(id) {

    }


    return {
        createStudent,
        getStudents,
        editStudent,
        updateStudent,
        deleteStudent,
        getStudentDetails,
        loading,
        test,
        student_details,
        Students,
        msg_success,
        msg_wrang, loading,
    }

});
