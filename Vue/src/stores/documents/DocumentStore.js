import { defineStore } from 'pinia'
import axiosClient from '../../axios';
import router from '../../routes';
import { ref } from 'vue';

export const useDocumentStore = defineStore('useDocument', () => {

    let msg_success = ref('');
    let msg_wrang = ref('');
    let loading = ref(false);

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

    let document = ref({
        number: '',
        source: '',
        destination: '',
        date: '',
        type: '',
        remark: '',
        description: '',
        attachment: '',
    });


    function createDocument(data) {
        loading.value = true
        let attachment = ''
        if (data.attachment instanceof File) {
            attachment = data.attachment
        }

        let form = new FormData();
        form.append('number', data.number);
        form.append('source', data.source);
        form.append('destination', data.destination);
        form.append('type', data.type);
        form.append('date', data.date);
        form.append('remark', data.remark);
        form.append('description', data.description);
        form.append('attachment', attachment);

        data = form;
        axiosClient.post('/document/create', data)
            .then((response) => {
                loading.value = false
                msg_success.value = response.data.message
            }).catch((error) => {
                loading.value = false
                msg_wrang.value = error.response.data.message
            })
    }

    // get all the documents and display them according to department
    function getDocuments({ url = null, id = '', search = '', sortField, sortDirection, per_page } = {}) {
        url = url || '/documents'
        const params = {
            per_page: 10,
        }
        axiosClient.get(url, {
            params: {
                ...params,
                url,
                id,
                search,
                sortDirection,
                sortField,
                per_page
            }
        }).then((response) => {
            console.log(response);
            Documents.loading.value = false
            setDocuments(response.data);
        }).catch((error) => {
            console.log('Something wrong happend ' + error.data.message);
            Documents.loading.value = false
        })

    }

    function setDocuments(data) {
        if (data) {
            Documents.value.loading = false;
            Documents.value.form = data.meta.from;
            Document.value.to = data.meta.to;
            Documents.value.links = data.meta.links;
            Documents.value.total = data.meta.total;
            Document.value.data = data.data;
        }
    }

    function editDocument(id) {
        axiosClient.get('')
            .then(() => {

            }).catch((error) => {

            })
    }

    function updateDocument(data, id) {
        axiosClient.post('')
            .then(() => {

            }).catch((error) => {

            })

    }

    function deleteDocument(id) {
        axiosClient.get('')
            .then(() => {

            }).catch((error) => {

            })
    }


    return {
        createDocument,
        getDocuments,
        editDocument,
        updateDocument,
        deleteDocument,
        msg_success,
        msg_wrang,
        Documents,
        document,
        loading,
    }



});
