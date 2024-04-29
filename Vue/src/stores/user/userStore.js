import { defineStore } from "pinia";
import axiosClient from "../../axios";
import { ref } from "vue";

export const useUserStore = defineStore("user", () => {
    let msg_success = ref("");
    let msg_wrang = ref("");
    let loading = ref(false);
    let user = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });
    const user_data = ref({
        id: "",
        name: "",
        email: "",
        user_type: "",
        position: "",
        password: "",
        password_confirmation: "",
        photo: "",
    });

    let permissions = ref({
        loading: false,
        data: [],
        links: [],
        from: null,
        to: null,
        page: 1,
        limit: null,
        total: null,
    });

    // user departments
    let user_departments = ref([]);

    function getUserDepartment() {
        axiosClient
            .get("/user_department")
            .then(({ data }) => {
                user_departments.value = data;
            })
            .catch((error) => {
                console.log(error);
            });
    }

    let permission_list = ref([]);
    let permission_current = ref({
        admin: false,
        //user
        user_view: false,
        user_create: false,
        user_delete: false,
        user_edit: false,

        // documents
        document_view: false,
        document_create: false,
        document_delete: false,
        document_edit: false,

        // teacher department
        teacher_view: false,
        teacher_create: false,
        teacher_delete: false,
        teacher_edit: false,

        // pdc department
        pdc_view: false,
        pdc_create: false,
        pdc_delete: false,
        pdc_edit: false,

        // quality asurenc
        teacher_view: false,
        teacher_create: false,
        teacher_delete: false,
        teacher_edit: false,

        // research department
    });

    function getUsers({
        url = null,
        search = "",
        per_page,
        sortField,
        sortDirection,
    } = {}) {
        user.value.loading = true;
        url = url || "/user";
        const params = {
            per_page: 10,
        };
        axiosClient
            .get(url, {
                params: {
                    ...params,
                    per_page,
                    sortField,
                    sortDirection,
                    search,
                },
            })
            .then((res) => {
                user.value.loading = false;
                setUsers(res.data);
            })
            .catch((err) => {
                user.value.loading = false;
                console.log(err);
            });
    }

    function setUsers(data) {
        if (data) {
            user.value.data = data;
            user.value.links = data.meta?.links;
            user.value.current_page = data.meta.current_page;
            user.value.from = data.meta.from;
            user.value.to = data.meta.to;
            user.value.total = data.meta.total;
            user.value.limit = data.meta.per_page;
        }
    }

    function createUser(data) {
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        var form = new FormData();
        form.append("name", data.name);
        form.append("email", data.email);
        form.append("password", data.password);
        form.append("position", data.position);
        form.append("user_type", data.user_type);
        form.append("password_confirmation", data.password_confirmation);
        form.append("photo", photo);
        data = form;
        axiosClient
            .post("/user/create", data)
            .then((res) => {
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.message;
            });
    }

    function getPermissions({ url = null, id, per_page } = {}) {
        permissions.value.loading = true;
        url = url || "/permission";
        const params = {
            per_page: 10,
        };

        axiosClient
            .get(url, {
                params: {
                    ...params,
                    per_page,
                    id,
                },
            })
            .then((res) => {
                console.log(res.data);
                permissions.value.loading = false;
                setPermission(res.data);
            })
            .catch((err) => {
                permissions.value.loading = false;
                console.log(err);
            });
    }

    function setPermission(data) {
        if (data) {
            permissions.value.data = data;
            permissions.value.links = data.meta?.links;
            permissions.value.current_page = data.meta.current_page;
            permissions.value.from = data.meta.from;
            permissions.value.to = data.meta.to;
            permissions.value.total = data.meta.total;
            permissions.value.limit = data.meta.per_page;
        }
    }

    function getUserPermission(id) {
        axiosClient
            .get(`/permission/list/${id}`)
            .then((res) => {
                permission_list.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function editUser(id = "") {
        axiosClient
            .get(`/user/edit/${id}`)
            .then((res) => {
                user_data.value = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function updateUser(data) {
        loading.value = true;
        let photo = "";
        if (data.photo instanceof File) {
            photo = data.photo;
        } else {
            photo = "";
        }

        var form = new FormData();
        form.append("id", data.id);
        form.append("name", data.name);
        form.append("email", data.email);
        form.append("password", data.password);
        form.append("position", data.position);
        form.append("user_type", data.user_type);
        form.append("password_confirmation", data.password_confirmation);
        form.append("photo", photo);
        data = form;
        axiosClient
            .post("/user/update", data)
            .then((res) => {
                loading.value = false;
                console.log(res);
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                loading.value = false;
                msg_wrang.value = err.response.data.message;
            });
    }

    function deleteUser(id) {
        axiosClient
            .get(`/user/delete/${id}`)
            .then((res) => {
                console.log(res);
                if (res.status === 200) {
                    msg_success.value = "یوزر موفقانه حذف گردید";
                }
            })
            .catch((err) => {
                msg_wrang.value = "یوزر  حذف نشد دوباره تلاش نماید";
            });
    }

    function createPermission(data) {
        axiosClient
            .post("/permission/store", data)
            .then((res) => {
                msg_success.value = res.data.message;
            })
            .catch((err) => {
                msg_wrang.value = err.response.data.error;
            });
    }

    function getCurrentPermission() {
        axiosClient.get("/user/current/permission").then(({ data }) => {
            data.forEach((item) => {
                if (item.id === 1) {
                    permission_current.value.admin = true;
                } else if (item.id === 2) {
                    permission_current.value.user_view = true;
                } else if (item.id === 3) {
                } else if (item.id === 4) {
                    permission_current.value.pdc_view = true;
                }
            });
        });
    }

    function deletePermission(user_id) {
        axiosClient
            .get(`/permission/delete/${user_id}`)
            .then((res) => {
                console.log(res);
                if (res.status === 200) {
                    msg_success.value = "صلاحیت موفقانه حذف گردید";
                }
            })
            .catch((err) => {
                msg_success.value = "صلاحیت  حذف نشد دوباره تلاش نماید";
            });
    }

    return {
        getUsers,
        getUserDepartment,
        getPermissions,
        getUserPermission,
        permission_list,
        createPermission,
        getCurrentPermission,
        permission_current,
        deletePermission,
        createUser,
        deleteUser,
        editUser,
        updateUser,
        user,
        user_data,
        permissions,
        user_departments,
        msg_success,
        msg_wrang,
        loading,
    };
});
