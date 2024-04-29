import { defineStore } from 'pinia'
import router from '../../routes'
import axiosClient from '../../axios'
import { pushScopeId, ref } from 'vue';

export const useTeacherStore = defineStore('teacher', () => {

    let msg_success = ref('');
    let msg_wrang = ref('');
    let msg_dsuccess = ref('');
    let msg_dwrang = ref('');
    let msg_qsuccess = ref('');
    let msg_qwrang = ref('');
    let msg_asuccess = ref('');
    let msg_awrang = ref('');
    let msg_lsuccess = ref('');
    let msg_lwrang = ref('');

    let loading = ref(false);
    let Teachers = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let Articles = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });


    let Documents = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let Literatures = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null
    });

    let teacher = ref({
        id: '',
        name: '',
        lname: '',
        fatherName: '',
        email: '',
        phone: '',
        gender: '',
        birth_date: '',
        main_address: '',
        current_address: '',
        hire_date: '',
        nic: '',
        photo: '',
        photo_path: '',
        academic_rank: '',
        faculty_id: '',
        department_id: '',
    });


    // teacher document
    let teacher_document = ref({
        id: '',
        type: '',
        document: '',
        description: '',
        attachment_path: ''
    });

    // teacher documents
    let teacher_qualification = ref({
        id: '',
        education_degree: '',
        graduated_year: '',
        university: '',
        country: '',
        description: '',
    });

    // teacher articles
    let teacher_articles = ref({
        id: '',
        date: '',
        title: '',
        publisher: ''
    });

    // teacher literature
    let teacher_literature = ref({
        id: '',
        name: '',
        date: '',
        description: '',
        publisher: ''
    });

    let faculties = ref([])
    let departments = ref([])


    // actions
    function createTeacher(data) {
        loading.value = true
        let photo = '';
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = ''
        }

        let form = new FormData();

        form.append('name', data.name);
        form.append('lname', data.lname);
        form.append('fatherName', data.fatherName);
        form.append('email', data.email);
        form.append('phone', data.phone);
        form.append('gender', data.gender);
        form.append('birth_date', data.birth_date);
        form.append('main_address', data.main_address);
        form.append('current_address', data.current_address);
        form.append('academic_rank', data.academic_rank);
        form.append('nic', data.nic);
        form.append('photo', photo);
        form.append('hire_date', data.hire_date);
        form.append('faculty_id', data.faculty_id);
        form.append('department_id', data.department_id);

        data = form;
        axiosClient.post(`teacher/create`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            });
    }

    function getFaculties() {
        axiosClient.get('/get/faculties')
            .then((res) => {
                faculties.value = res.data.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function getDepartments(id) {
        axiosClient.get(`/get/departments/${id}`)
            .then((res) => {
                departments.value = res.data.data;
            }).catch((err) => {
                console.log(err);
            })
    }


    function getTeachers({ url = null, per_page, search = '', department='',  sortDirection, sortField } = {}) {
        Teachers.value.loading = true;
        url = url || '/teacher'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                search,
                department, 
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Teachers.value.loading = false
            setTeacher(response.data);
        }).catch((err) => {
            Teachers.value.loading = false
            console.log(err);
        })
    }

    function setTeacher(data) {
        if (data) {
            Teachers.value.data = data.data;
            Teachers.value.links = data.meta?.links;
            Teachers.value.to = data.meta.to;
            Teachers.value.from = data.meta.from;
            Teachers.value.current_page = data.meta.current_page;
            Teachers.value.total = data.meta.total;
        }
    }


    function getTeacherDetails(id) {
        axiosClient.get(`teacher/details/${id}`)
            .then(({ data }) => {
                teacher.value = data
            }).catch((err) => {
                console.log(err);
            })
    }




    function editTeacher(id) {
        axiosClient.get(`/teacher/edit/${id}`)
            .then((res) => {
                teacher.value = res.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function updateTeacher(data) {
        loading.value = true
        let photo = '';
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = ''
        }

        let form = new FormData();

        form.append('id', data.id);
        form.append('name', data.name);
        form.append('lname', data.lname);
        form.append('fatherName', data.fatherName);
        form.append('email', data.email);
        form.append('phone', data.phone);
        form.append('gender', data.gender);
        form.append('birth_date', data.birth_date);
        form.append('main_address', data.main_address);
        form.append('current_address', data.current_address);
        form.append('academic_rank', data.academic_rank);
        form.append('nic', data.nic);
        form.append('photo', photo);
        form.append('hire_date', data.hire_date);
        form.append('faculty_id', data.faculty_id);
        form.append('department_id', data.department_id);

        data = form;
        axiosClient.post(`teacher/update`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteTeacher(id) {
        axiosClient.get(`/teacher/delete/${id}`)
            .then((res) => {
                console.log(res);
                if (res.status == 200) {
                    msg_success.value = "موفقانه حذف شد"
                }
            }).catch((err) => {
                msg_wrang.value = 'فاکولته موفقانه حذف نشد'
            })
    }
    //  teacher qualification, article, literature

    function createQualification(data, id) {
        console.log(id);
        loading.value = true
        axiosClient.post(`/teacher/qualification/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
                teacher_qualification.value.date = ''
                teacher_qualification.value.graduated_year = ''
                teacher_qualification.value.education_degree = ''
                teacher_qualification.value.country = ''
                teacher_qualification.value.university = ''
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message
            })

    }

    function getQualification(id) {
        axiosClient.get(`/teacher/qualification/${id}`)
            .then((res) => {
                console.log(res);
                teacher_qualification.value = res.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function updateQualification(data, id) {
        loading.value = true
        axiosClient.post(`/teacher/qualification/update/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_qsuccess.value = res.data.message
            }).catch((err) => {
                msg_qwrang = err.response.data.message
            })
    }

    function deleteQualification(id) {
        loading.value = true
        axiosClient.get(`/teacher/qualification/delete/${id}`)
            .then((res) => {
                loading.value = false
                if (res.status === 200) {
                    msg_qsuccess.value = 'در خواست حذف موفقانه انجام شد'
                }
            }).catch((err) => {
                loading.value = false
                msg_qwrang.value = 'در خواست حذف  موفقانه انجام نشد دوباره تلاش نماید'
            })
    }


    //  teacher article,
    function createArticle(data, id) {
        alert(id)
        loading.value = true
        axiosClient.post(`/teacher/article/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
                teacher_articles.value.date = ''
                teacher_articles.value.title = ''
                teacher_articles.value.publisher = ''
            }).catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message
            })
    }




    function getArticles({ url = null, per_page, search = '', sortDirection, sortField, id } = {}) {
        Articles.value.loading = true;
        url = url || '/teacher/article'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                id,
                url,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Articles.value.loading = false
            setArticle(response.data);
        }).catch((err) => {
            Articles.value.loading = false
            console.log(err);
        })
    }

    function setArticle(data) {
        if (data) {
            Articles.value.data = data.data;
            Articles.value.links = data.meta?.links;
            Articles.value.to = data.meta.to;
            Articles.value.from = data.meta.from;
            Articles.value.current_page = data.meta.current_page;
            Articles.value.total = data.meta.total;
        }
    }


    function getArticle(id) {
        axiosClient.get(`/teacher/article/edit/${id}`)
            .then((res) => {
                teacher_articles.value = res.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function updateArticle(data, id) {
        loading.value = true
        axiosClient.post(`/teacher/article/update/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_asuccess.value = res.data.message
                router.push({ name: 'app.teacher.details', params: { id: id } })
            }).catch((err) => {
                msg_awrang = err.response.data.message
            })
    }

    function deleteArticle(id) {
        axiosClient.get(`/teacher/article/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_asuccess.value = 'در خواست حذف شد'
                }
            }).catch((err) => {
                msg_awrang.value = 'در خواست حذف نشد دوباره تلاش نماید'
            })
    }


    //  teacher literature,

    function createLiterature(data, id) {
        loading.value = true
        axiosClient.post(`/teacher/literature/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_lsuccess.value = res.data.message
                teacher_literature.value.date = ''
                teacher_literature.value.description = ''
                teacher_literature.value.name = ''
                teacher_literature.value.publisher = ''
            }).catch((err) => {
                loading.value = false
                msg_lwrang.value = err.response.data.message
            })
    }


    function getLiteratures({ url = null, per_page, search = '', sortDirection, sortField, id } = {}) {
        Literatures.value.loading = true;
        url = url || '/teacher/literature'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                id,
                url,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Literatures.value.loading = false
            setLiterature(response.data);
        }).catch((err) => {
            Literatures.value.loading = false
            console.log(err);
        })
    }

    function setLiterature(data) {
        if (data) {
            Literatures.value.data = data.data;
            Literatures.value.links = data.meta?.links;
            Literatures.value.to = data.meta.to;
            Literatures.value.from = data.meta.from;
            Literatures.value.current_page = data.meta.current_page;
            Literatures.value.total = data.meta.total;
        }
    }


    function getLiterature(id) {
        axiosClient.get(`/teacher/literature/${id}`)
            .then((res) => {
                teacher_literature.value = res.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function updateLiterature(data, id) {
        loading.value = true
        axiosClient.post(`/teacher/literature/update/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_lsuccess.value = res.data.message
            }).catch((err) => {
                msg_lwrang = err.response.data.message
            })
    }

    function deleteLiterature(id) {
        axiosClient.get(`/teacher/literature/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    msg_lsuccess.value = 'در خواست حذف موفقانه انجام شد'
                }
            }).catch((err) => {
                msg_lwrang.value = 'در خواست حذف نشد دوباره تلاش نماید'
            })
    }



    //  teacher document,

    function getDocuments({ url = null, per_page, search = '', sortDirection, sortField, id } = {}) {
        Documents.value.loading = true;
        url = url || '/teacher/document'
        const params = {
            per_page: 10
        }
        axiosClient.get(url, {
            params: {
                ...params,
                id,
                url,
                search,
                per_page,
                sortDirection,
                sortField
            }
        }).then((response) => {
            console.log(response);
            Documents.value.loading = false
            setDocument(response.data);
        }).catch((err) => {
            Documents.value.loading = false
            console.log(err);
        })
    }

    function setDocument(data) {
        if (data) {
            Documents.value.data = data.data;
            Documents.value.links = data.meta?.links;
            Documents.value.to = data.meta.to;
            Documents.value.from = data.meta.from;
            Documents.value.current_page = data.meta.current_page;
            Documents.value.total = data.meta.total;
        }
    }

    function createDocument(data, id) {
        let document = ''
        if (data.document instanceof File) {
            document = data.document
        } else {
            document = ''
        }

        var form = new FormData();

        form.append('type', data.type);
        form.append('document', document);
        form.append('description', data.description);

        data = form;
        loading.value = true
        axiosClient.post(`/teacher/document/create/${id}`, data)
            .then((res) => {
                loading.value = false
                msg_success.value = res.data.message
                teacher_document.value.date = ''
                teacher_document.value.description = ''
                teacher_document.value.name = ''
                teacher_document.value.publisher = ''
            }).catch((err) => {
                loading.value = false
                msg_wrang.value = err.response.data.message
            })
    }

    function getDocument(id) {
        axiosClient.get(`/teacher/document/edit/${id}`)
            .then((res) => {
                teacher_document.value = res.data;
            }).catch((err) => {
                console.log(err);
            })
    }

    function updateDocument(data, id) {

        loading.value = true
        let document = ''
        if (data.document instanceof File) {
            document = data.document
        } else {
            document = ''
        }

        var form = new FormData();

        form.append('id', data.id);
        form.append('type', data.type);
        form.append('document', document);
        form.append('description', data.description);
        data = form;

        axiosClient.post(`/teacher/document/update/${id}`, data)
            .then((res) => {
                console.log(res);
                loading.value = false
                msg_dsuccess.value = res.data.message
                router.push({ name: 'app.teacher.details', params: { id: id } })
            }).catch((err) => {
                msg_dwrang = err.response.data.message
            })
    }

    function deleteDocument(id) {
        loading.value = true
        axiosClient.get(`/teacher/document/delete/${id}`)
            .then((res) => {
                if (res.status === 200) {
                    loading.value = false
                    msg_dsuccess.value = 'مورد حذف شد'
                }
            }).catch((err) => {
                loading.value = false
                msg_dwrang.value = 'در خواست حذف نشد دوباره تلاش نماید'
            })
    }


    // get all departments
   let allDepartments = ref([]);
   function getAlldepartments() {
       axiosClient.get('/teacher/get_all_department')
          .then((response)=>{
               allDepartments.value = response.data;
          }).catch((error)=>{
             console.log(error.message);
          })
    }


    return {
        getTeachers,
        getFaculties,
        createTeacher,
        getTeacherDetails,
        // getFacultyDepartment,
        getFaculties,
        getDepartments,
        editTeacher,
        updateTeacher,
        deleteTeacher,
        faculties,
        departments,
        Teachers,
        teacher,
        // teacher qualification
        createQualification,
        getQualification,
        deleteQualification,
        updateQualification,
        // teacher article
        createArticle,
        updateArticle,
        getArticle,
        getArticles,
        deleteArticle,
        // teacher literature
        createLiterature,
        updateLiterature,
        getLiterature,
        getLiteratures,
        deleteLiterature,

        // teacher document
        createDocument,
        getDocument,
        getDocuments,
        updateDocument,
        deleteDocument,

        // get all dependencies
        getAlldepartments,

        teacher_articles,
        teacher_document,
        teacher_literature,
        Literatures,
        Documents,
        teacher_qualification,
        Articles,
        teacher_literature,
        allDepartments,

        // common ref
        loading,
        msg_success,
        msg_wrang,
        msg_dsuccess,
        msg_dwrang,
        msg_asuccess,
        msg_awrang,
        msg_lsuccess,
        msg_lwrang,
        msg_qsuccess,
        msg_qwrang,
    }

})
