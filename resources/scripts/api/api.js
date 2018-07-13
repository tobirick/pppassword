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
        fetchAll: clientId => {
            return axios
                .get(`/api/clients/${clientId}/passwords`)
                .then(response => response.data);
        },
        fetchOne: (clientId, passwordRecordId) => {
            return axios
                .get(`/api/clients/${clientId}/passwords/${passwordRecordId}`)
                .then(response => response.data);
        },
        create: (clientId, passwordRecord) => {
            return axios
                .post(`/api/clients/${clientId}/passwords`, { passwordRecord })
                .then(response => response.data);
        },
        update: (clientId, passwordRecordId, passwordRecord) => {
            return axios
                .put(`/api/clients/${clientId}/passwords/${passwordRecordId}`, {
                    passwordRecord
                })
                .then(response => response.data);
        },
        delete: (clientId, passwordRecordId) => {
            return axios
                .delete(
                    `/api/clients/${clientId}/passwords/${passwordRecordId}`
                )
                .then(response => response.data);
        }
    }
};
