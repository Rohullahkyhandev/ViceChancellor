import { createRouter, createWebHistory } from 'vue-router'


import DashboardChart from '../views/liner.vue'
import Dashboard from '../components/Dashboard.vue'
import AppLayout from '../components/AppLayout.vue'
import Login from '../components/Login.vue'
import NotFound from '../components/NotFound.vue'
import { useAuthStore } from '../stores/auth'


// user
import CreateUser from '../views/users/create.vue'
import UserList from '../views/users/index.vue'
import UserEdit from '../views/users/edit.vue'
import UserDelete from '../views/users/delete.vue'
import UserPermission from '../views/users/userPermission.vue'
import CreatePermission from '../views/users/createPermission.vue'

// // pdc
// import PDC_Document from '../views/pdc/table.vue'



// documents
import tableDocument from '../views/documents/table.vue'
import listDocument from '../views/documents/index.vue'
import newDocumentCreate from '../views/documents/create.vue'
import draftDocument from '../views/documents/document_draft.vue'
// import draftDocument from '../views/documents/document_draft.vue'

// pdc plan
import CreatePlan from '../views/pdc/plan/create.vue'
import ListPlan from '../views/pdc/plan/index.vue'
import EditPlan from '../views/pdc/plan/edit.vue'


// pdc archive
import CreateArchive from '../views/pdc/pdcArchives/create.vue'
import ListArchive from '../views/pdc/pdcArchives/index.vue'
import EditArchive from '../views/pdc/pdcArchives/edit.vue'

// faculty
import CreateFaculty from '../views/faculties/create.vue'
import ListFaculty from '../views/faculties/index.vue'
import detailsFaculty from '../views/faculties/details.vue'
import EditFaculty from '../views/faculties/edit.vue'

// department
import CreateDepartment from '../views/department/create.vue'
import EditDepartment from '../views/department/edit.vue'
import teacherDepartment from '../views/department/department_teacher.vue'

// teacher
import CreateTeacher from '../views/teachers/create.vue'
import ListTeacher from '../views/teachers/index.vue'
import detailsTeacher from '../views/teachers/details.vue'
import editTeacher from '../views/teachers/edit.vue'
import createQualification from '../views/teachers/qualification.vue'
import editQualification from '../views/teachers/edit_qualification.vue'

// teacher document
import createDocument from '../views/teachers/document.vue'
import editDocument from '../views/teachers/edit_document.vue'
// teacher literature
import createLiterature from '../views/teachers/literature.vue'

// articles
import createArticle from '../views/teachers/article.vue'
import editArticle from '../views/teachers/article_edit.vue'


// students
import createStudent from '../views/students/create.vue'
import StudentList from '../views/students/index.vue'
import StudentDetails from '../views/students/details.vue'
import StudentEdit from '../views/students/edit.vue'

const routes = [

    {
        path: '/',
        redirect: '/app'
    },

    {
        path: '/app',
        name: 'app',
        redirect: '/app/dashboard',
        component: AppLayout,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: 'chart',
                name: 'app.chart',
                component: DashboardChart
            },
            // chart
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },

            // users
            {
                path: 'user/create',
                name: 'app.user.create',
                component: CreateUser
            },
            {
                path: 'user/edit/:id',
                name: 'app.user.edit',
                component: UserEdit
            },

            {
                path: 'user/permission/:id',
                name: 'app.user.permission',
                component: UserPermission
            },

            {
                path: 'user/create/permission/:id',
                name: 'app.user.permission_create',
                component: CreatePermission
            },

            {
                path: 'user/list',
                name: 'app.user.list',
                component: UserList
            },


            // documents
            {
                path: 'documents',
                name: 'app.documents',
                redirect: '/document/list',
                component: tableDocument,
                children: [
                    {
                        path: '/document/list',
                        name: 'app.document.list',
                        component: listDocument
                    },

                    {
                        path: '/document/new/create',
                        name: 'app.document_new.create',
                        component: newDocumentCreate
                    },

                    {
                        path: '/document/draft/create',
                        name: 'app.document_draft.create',
                        component: draftDocument
                    }
                ]
            },
            // // pdc
            // {
            //     path: '/pdc/documents',
            //     name: 'app.pdc.documents',
            //     redirect: '/pdc/documents/received',
            //     component: PDC_Document,
            //     children: [
            //         // send documents route
            //         {
            //             path: 'send',
            //             name: 'app.pdc.send_document',
            //             component: SendDocument,
            //         },
            //         // received document
            //         {
            //             path: 'received',
            //             name: 'app.pdc.received_document',
            //             component: ReceivedDocument,
            //         },

            //         // unprocessed documents
            //         {
            //             path: 'document/create',
            //             name: 'app.pdc.document.create',
            //             component: unProcessDocCreate
            //         }
            //     ],

            // },






            //plan
            {
                path: 'plan/create',
                name: 'app.pdc.plan.create',
                component: CreatePlan
            },
            {
                path: 'plan/list',
                name: 'app.pdc.plan.list',
                component: ListPlan
            },
            {
                path: 'plan/edit/:id',
                name: 'app.pdc.plan.edit',
                component: EditPlan
            },

            // archive
            {
                path: 'archive/create',
                name: 'app.pdc.archive.create',
                component: CreateArchive
            },
            {
                path: 'archive/list',
                name: 'app.pdc.archive.list',
                component: ListArchive
            },
            {
                path: 'archive/edit/:id',
                name: 'app.pdc.archive.edit',
                component: EditArchive
            },

            // faculties
            {
                path: 'faculty/create',
                name: 'app.faculty.create',
                component: CreateFaculty
            },
            {
                path: 'faculty/list',
                name: 'app.faculty.list',
                component: ListFaculty
            },
            {
                path: 'faculty/details/:id',
                name: 'app.faculty.details',
                component: detailsFaculty
            },

            {
                path: 'faculty/edit/:id',
                name: 'app.faculty.edit',
                component: EditFaculty
            },

            // departments
            {
                path: 'faculty/department/create/:id',
                name: 'app.faculty.department.create',
                component: CreateDepartment
            },


            {
                path: 'faculty/department/edit/:id',
                name: 'app.faculty.department.edit',
                component: EditDepartment
            },

            {
                path: 'faculty/department/teacher/:id',
                name: 'app.department.teacher',
                component: teacherDepartment
            },

            // teacher
            {
                path: 'faculty/teacher/create',
                name: 'app.teacher.create',
                component: CreateTeacher
            },
            {
                path: 'teacher/list',
                name: 'app.teacher.list',
                component: ListTeacher
            },
            {
                path: 'teacher/details/:id',
                name: 'app.teacher.details',
                component: detailsTeacher
            },
            {
                path: 'teacher/edit/:id',
                name: 'app.teacher.edit',
                component: editTeacher
            },

            {
                path: 'qualification/create/:id',
                name: 'app.qualification.create',
                component: createQualification
            },

            {
                path: 'qualification/edit/:id',
                name: 'app.teacher.qualification.edit',
                component: editQualification
            },

            {
                path: 'document/create/:id',
                name: 'app.document.create',
                component: createDocument
            },

            {
                path: 'document/edit/:id/:t_id',
                name: 'app.document.edit',
                component: editDocument
            },

            {
                path: 'article/create/:id',
                name: 'app.teacher.article.create',
                component: createArticle
            },

            {
                path: 'article/edit/:id/:t_id',
                name: 'app.article.edit',
                component: editArticle
            },

            {
                path: 'literature/create/:id',
                name: 'app.literature.create',
                component: createLiterature
            },

            // students
            {
                path: 'student/create',
                name: 'app.student.create',
                component: createStudent
            },
            {
                path: 'student/list',
                name: 'app.student.list',
                component: StudentList
            },
            {
                path: 'student/details/:id',
                name: 'app.student.details',
                component: StudentDetails
            },

            {
                path: 'student/edit/:id',
                name: 'app.student.edit',
                component: StudentEdit
            }


        ]
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/:pathMatch(.*)',
        name: 'notfound',
        component: NotFound
    },

]



const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.user.token) {
        next({ name: 'login' })
    } else if (authStore.user.token && to.meta.requiresGuest) {
        next({ name: 'app.dashboard' })
    }
    else {
        next();
    }
})

export default router;
