import axios from "axios";

export default {
    users: {
        fetchAll: () => {
            return axios.get("/api/users").then(response => response.data);
        },
        fetchOne: id => {
            return axios
                .get(`/api/users/${id}`)
                .then(response => response.data);
        },
        create: user => {
            return axios
                .post("/api/users", { user })
                .then(response => response.data);
        },
        update: (id, user) => {
            return axios
                .put(`/api/users/${id}`, { user })
                .then(response => response.data);
        },
        delete: id => {
            return axios
                .delete(`/api/users/${id}`)
                .then(response => response.data);
        }
    },
    clients: {
        fetchAll: () => {
            return axios.get("/api/clients").then(response => response.data);
        },
        fetchOne: id => {
            return axios
                .get(`/api/clients/${id}`)
                .then(response => response.data);
        },
        create: client => {
            return axios
                .post("/api/clients", { client })
                .then(response => response.data);
        },
        update: (id, client) => {
            return axios
                .put(`/api/clients/${id}`, { client })
                .then(response => response.data);
        },
        delete: id => {
            return axios
                .delete(`/api/clients/${id}`)
                .then(response => response.data);
        }
    },
    passwordRecords: {
        fetchAll: () => {
            return axios.get(`/api/passwords`).then(response => response.data);
        },
        fetchOne: passwordRecordId => {
            return axios
                .get(`/api/passwords/${passwordRecordId}`)
                .then(response => response.data);
        },
        create: passwordRecord => {
            return axios
                .post(`/api/passwords`, { passwordRecord })
                .then(response => response.data);
        },
        update: (passwordRecordId, passwordRecord) => {
            return axios
                .put(`/api/passwords/${passwordRecordId}`, {
                    passwordRecord
                })
                .then(response => response.data);
        },
        delete: passwordRecordId => {
            return axios
                .delete(`/api/passwords/${passwordRecordId}`)
                .then(response => response.data);
        }
    },
    folders: {
        fetchAll: () => {
            return axios.get(`/api/folders`).then(response => response.data);
        },
        fetchOne: folderId => {
            return axios
                .get(`/api/folders/${folderId}`)
                .then(response => response.data);
        },
        create: folder => {
            return axios
                .post(`/api/folders`, { folder })
                .then(response => response.data);
        },
        update: (folderId, folder) => {
            return axios
                .put(`/api/folders/${folderId}`, {
                    folder
                })
                .then(response => response.data);
        },
        delete: folderId => {
            return axios
                .delete(`/api/folders/${folderId}`)
                .then(response => response.data);
        }
    }
};
