import ko from "knockout";

import "knockout.validation";

import Folder from "./Models/Folder";
import Password from "./Models/Password";
import Client from "./Models/Client";
import api from "../api";

ko.validation.init({
    decorateInputElement: true,
    insertMessages: true,
    messagesOnModified: true,
    grouping: {
        deep: true,
        live: true,
        observable: true
    },
    errorMessageClass: "form-error__message",
    errorElementClass: "form-input--error"
});

class MainViewModel {
    constructor() {
        this.folders = ko.observableArray([]);
        this.clients = ko.observableArray([]);
        this.currentFolder = ko.observable(null);
        this.breadcrumbs = ko.observableArray([]);

        this.selectedPassword = ko.validatedObservable(null);
        this.selectedFolder = ko.validatedObservable(null);

        document.body.addEventListener("click", event => {
            //this.closePopup();
        });

        this.newPasswordPopupOpen = ko.observable(false);
        this.newFolderPopupOpen = ko.observable(false);
        this.editPasswordPopupOpen = ko.observable(false);
        this.editFolderPopupOpen = ko.observable(false);
        this.deletePasswordPopupOpen = ko.observable(false);
        this.deleteFolderPopupOpen = ko.observable(false);
        this.viewPasswordPopupOpen = ko.observable(false);

        this.newFolderVM = ko.validatedObservable(new Folder({}));
        this.newPasswordVM = ko.validatedObservable(new Password({}));

        this.clientsFilterValue = ko.observable(null);

        this.filteredClients = ko.computed(() => {
            let password;

            if (this.selectedPassword()) {
                password = this.selectedPassword();
            } else {
                password = this.newPasswordVM();
            }

            const clients = this.clients().filter(client => {
                const notUsed =
                    password
                        .clients()
                        .filter(
                            passwordClient => passwordClient.id === client.id
                        ).length === 0;

                return (
                    this.clientsFilterValue() &&
                    client.name
                        .toLowerCase()
                        .indexOf(this.clientsFilterValue().toLowerCase()) !==
                        -1 &&
                    notUsed
                );
            });

            return clients;
        });

        this.filterOpen = ko.observable(false);
        this.filterActive = ko.observable(false);

        const filtersFromLocalStorage = JSON.parse(
            localStorage.getItem("filters")
        );
        this.filters = {
            nameTextFilter: ko.observable(
                filtersFromLocalStorage.nameTextFilter || ""
            ),
            tagsTextFilter: ko.observable(
                filtersFromLocalStorage.tagsTextFilter || ""
            ),
            clientsFilter: {
                textFilter: ko.observable(
                    filtersFromLocalStorage.clientsFilter.textFilter || ""
                ),
                clients: ko.observableArray([])
            },
            types: ko.observableArray(
                filtersFromLocalStorage.types || [
                    "clients",
                    "folders",
                    "passwords"
                ]
            )
        };

        this.filteredClientsForFilter = ko.computed(() => {
            const clients = this.clients().filter(client => {
                const notUsed =
                    this.filters.clientsFilter
                        .clients()
                        .filter(
                            passwordClient => passwordClient.id === client.id
                        ).length === 0;

                return (
                    this.filters.clientsFilter.textFilter() &&
                    client.name
                        .toLowerCase()
                        .indexOf(
                            this.filters.clientsFilter
                                .textFilter()
                                .toLowerCase()
                        ) !== -1 &&
                    notUsed
                );
            });

            return clients;
        });

        this.filteredFolders = ko.computed(() => {
            this.setFilterToLocalStorage();
            let foldersToFilter = [];
            if (this.currentFolder()) {
                foldersToFilter = this.currentFolder().childrenFolders();
            } else {
                foldersToFilter = this.folders();
            }

            const folders = foldersToFilter.filter(folder => {
                const nameTextFilter = folder
                    .name()
                    .toLowerCase()
                    .includes(this.filters.nameTextFilter().toLowerCase());
                const clientFilter =
                    this.filters.clientsFilter.clients().length === 0 ||
                    (folder.isClient() &&
                        this.filters.clientsFilter
                            .clients()
                            .filter(
                                client =>
                                    client.id === folder.clientDetails().id
                            ).length > 0);

                return nameTextFilter && clientFilter;
            });

            return folders;
        });

        this.filteredPasswords = ko.computed(() => {
            this.setFilterToLocalStorage();
            let passwordsToFilter = [];
            if (this.currentFolder()) {
                passwordsToFilter = this.currentFolder().passwordRecords();
            }

            const passwords = passwordsToFilter.filter(password => {
                const nameTextFilter = password
                    .title()
                    .toLowerCase()
                    .includes(this.filters.nameTextFilter().toLowerCase());
                const tagsTextFilter =
                    password
                        .tags()
                        .filter(tag =>
                            tag.title
                                .toLowerCase()
                                .includes(
                                    this.filters.tagsTextFilter().toLowerCase()
                                )
                        ).length > 0;

                return nameTextFilter && tagsTextFilter;
            });

            return passwords;
        });
    }

    setFilterToLocalStorage = () => {
        localStorage.setItem("filters", JSON.stringify(ko.toJS(this.filters)));
    };

    addClientToFilter = client => {
        if (this.filters.clientsFilter.clients().indexOf(client) === -1) {
            this.filters.clientsFilter.clients.push(client);
        }
    };

    deleteClientFromFilter = client => {
        this.filters.clientsFilter.clients.remove(client);
    };

    toggleFilter = () => {
        this.filterOpen(!this.filterOpen());
    };

    fetchFolders = async () => {
        const foldersFromAPI = await api.folders.fetchAll();

        const folders = ko.utils.arrayMap(foldersFromAPI, function(folder) {
            return new Folder(folder);
        });
        this.folders(folders);
    };

    fetchClients = async () => {
        const clientsFromAPI = await api.clients.fetchAll();

        const clients = ko.utils.arrayMap(clientsFromAPI, function(client) {
            return new Client(client);
        });
        this.clients(clients);
    };

    setCurrentFolder = folder => {
        // Check if Folder already exists
        const alreadyExists = this.breadcrumbs().filter(breadcrumbItem => {
            return breadcrumbItem.id === folder.id;
        });

        // If Folder exists, remove all Items after this Folder in Breadcrumbs array
        if (alreadyExists.length > 0) {
            const index = this.breadcrumbs().indexOf(alreadyExists[0]);
            const newBreadcrumbs = this.breadcrumbs().slice(0, index + 1);
            this.currentFolder(folder);
            this.breadcrumbs(newBreadcrumbs);
            this.setLocalStorage();

            return;
        }

        this.currentFolder(folder);
        this.breadcrumbs.push(folder);
        this.setLocalStorage();
    };

    setRootFolder = () => {
        this.currentFolder(null);
        this.breadcrumbs([]);
        this.setLocalStorage();
    };

    setLocalStorage = () => {
        localStorage.setItem(
            "currentFolder",
            JSON.stringify(ko.toJS(this.currentFolder()))
        );
        localStorage.setItem(
            "breadcrumbs",
            JSON.stringify(ko.toJS(this.breadcrumbs()))
        );
    };

    createFolder = async () => {
        ko.validation.group(this.newFolderVM).showAllMessages();
        if (!this.newFolderVM.isValid()) {
            return;
        }
        const folder = {
            name: this.newFolderVM().name() || "",
            position: null,
            parentId: this.currentFolder() ? this.currentFolder().id : null,
            clientId: null,
            isClient: this.newFolderVM().isClient() ? 1 : 0
        };

        if (folder.isClient === 1) {
            folder.client = {
                email:
                    this.newFolderVM()
                        .clientDetails()
                        .email() || "",
                phone: this.newFolderVM().clientDetails().phone || "",
                mobilePhone:
                    this.newFolderVM().clientDetails().mobilePhone || "",
                notes: this.newFolderVM().clientDetails().notes || "",
                city: this.newFolderVM().clientDetails().city || "",
                plz: this.newFolderVM().clientDetails().plz || "",
                street: this.newFolderVM().clientDetails().street || ""
            };
        }

        const newFolderFromAPI = await api.folders.create(folder);
        if (newFolderFromAPI) {
            const newFolder = new Folder(newFolderFromAPI);

            if (newFolder.isClient()) {
                const client = new Client(newFolderFromAPI);
                this.clients.push(client);
            }

            if (this.currentFolder()) {
                this.currentFolder().childrenFolders.push(newFolder);
            } else {
                this.folders.push(newFolder);
            }

            this.newFolderVM(new Folder({}));

            this.closePopup();
        } else {
            // Show Error Message
            console.log("Something went wrong!");
        }
    };

    createPasswordRecord = async () => {
        ko.validation.group(this.newPasswordVM).showAllMessages();
        if (!this.newPasswordVM.isValid()) {
            return;
        }
        const password = {
            title: this.newPasswordVM().title() || "",
            url: this.newPasswordVM().url || "",
            email: this.newPasswordVM().email() || "",
            username: this.newPasswordVM().username || "",
            password: this.newPasswordVM().password || "",
            notes: this.newPasswordVM().notes || "",
            clients: this.newPasswordVM()
                .clients()
                .map(client => client.id),
            tags: this.newPasswordVM().tags(),
            entryFields: this.newPasswordVM().entryFields()
        };

        const newPasswordFromAPI = await api.passwordRecords.create(password);
        if (newPasswordFromAPI) {
            const newPassword = new Password(newPasswordFromAPI);

            newPasswordFromAPI.clients.forEach(client => {
                const foundClient = this.findClientByClientID(client.id);
                if (foundClient) {
                    this.addPasswordToClient(newPassword, foundClient);
                }
            });

            this.newPasswordVM(new Password({}));

            this.closePopup();
        } else {
            // Show Error Message
            console.log("Something went wrong!");
        }
    };

    addPasswordToClient = (password, client) => {
        client.passwordRecords.push(password);
    };

    findClientByClientID = (id, folders = []) => {
        let searchableFolders = [];
        if (folders.length > 0) {
            searchableFolders = folders;
        } else {
            searchableFolders = this.folders();
        }

        if (searchableFolders) {
            for (let i = 0; i < searchableFolders.length; i++) {
                if (
                    searchableFolders[i].isClient() &&
                    searchableFolders[i].clientDetails().id === id
                ) {
                    return searchableFolders[i];
                }

                if (searchableFolders[i].childrenFolders().length > 0) {
                    let found = this.findClientByClientID(
                        id,
                        searchableFolders[i].childrenFolders()
                    );
                    if (found) return found;
                }
            }
        }
        return false;
    };

    openNewFolderPopup = () => {
        this.newFolderPopupOpen(true);
    };

    openNewPasswordPopup = () => {
        this.newPasswordPopupOpen(true);
    };

    openPasswordPopup = password => {
        this.selectedPassword(password);
        this.viewPasswordPopupOpen(true);
    };

    openEditPasswordPopup = password => {
        password.dropdownMenuOpen(false);
        this.selectedPassword(password);
        this.editPasswordPopupOpen(true);
    };

    openEditFolderPopup = folder => {
        folder.dropdownMenuOpen(false);
        this.selectedFolder(folder);
        this.editFolderPopupOpen(true);
    };

    openDeletePasswordPopup = password => {
        password.dropdownMenuOpen(false);
        this.selectedPassword(password);
        this.deletePasswordPopupOpen(true);
    };

    openDeleteFolderPopup = folder => {
        folder.dropdownMenuOpen(false);
        this.selectedFolder(folder);
        this.deleteFolderPopupOpen(true);
    };

    closePopup = () => {
        this.selectedPassword(null);
        this.selectedFolder(null);
        this.newFolderPopupOpen(false);
        this.newPasswordPopupOpen(false);
        this.editFolderPopupOpen(false);
        this.editPasswordPopupOpen(false);
        this.deleteFolderPopupOpen(false);
        this.deletePasswordPopupOpen(false);
        this.viewPasswordPopupOpen(false);
    };

    updateFolder = async () => {
        const folder = this.selectedFolder();
        ko.validation.group(folder).showAllMessages();
        if (!this.selectedFolder.isValid()) {
            return;
        }

        const folderToSave = {
            name: folder.name() || "",
            position: null,
            parentId: this.currentFolder() ? this.currentFolder().id : null,
            clientId: null,
            isClient: folder.isClient() ? 1 : 0
        };

        if (folderToSave.isClient === 1) {
            folderToSave.client = {
                id: folder.clientDetails().id,
                email: folder.clientDetails().email() || "",
                phone: folder.clientDetails().phone || "",
                mobilePhone: folder.clientDetails().mobilePhone || "",
                notes: folder.clientDetails().notes || "",
                city: folder.clientDetails().city || "",
                plz: folder.clientDetails().plz || "",
                street: folder.clientDetails().street || ""
            };
        }

        const updatedFolderFromAPI = await api.folders.update(
            folder.id,
            folderToSave
        );

        if (updatedFolderFromAPI) {
            const updatedFolder = new Folder(updatedFolderFromAPI);

            let parentFolders = [];
            if (this.currentFolder() === null) {
                parentFolders = this.folders;
            } else {
                parentFolders = this.currentFolder().childrenFolders;
            }

            const oldFolder = parentFolders().find(
                oldFolder => oldFolder.id === updatedFolder.id
            );
            parentFolders.replace(oldFolder, updatedFolder);
            this.closePopup();
        }
    };

    updatePassword = async () => {
        const password = this.selectedPassword();
        ko.validation.group(password).showAllMessages();
        if (!this.selectedPassword.isValid()) {
            return;
        }

        const passwordToSave = {
            title: password.title() || "",
            url: password.url || "",
            email: password.email() || "",
            username: password.username || "",
            password: password.password || "",
            notes: password.notes || "",
            clients: password.clients().map(client => client.id),
            tags: password.tags(),
            entryFields: password.entryFields()
        };

        const updatedPasswordFromAPI = await api.passwordRecords.update(
            password.id,
            passwordToSave
        );

        if (updatedPasswordFromAPI) {
            updatedPasswordFromAPI.clients.forEach(client => {
                const updatedPassword = new Password(updatedPasswordFromAPI);
                const foundClient = this.findClientByClientID(client.id);
                if (foundClient) {
                    const oldPassword = foundClient
                        .passwordRecords()
                        .find(
                            oldPassword => oldPassword.id === updatedPassword.id
                        );
                    foundClient.passwordRecords.replace(
                        oldPassword,
                        updatedPassword
                    );
                    this.closePopup();
                }
            });
        }
    };

    deletePassword = password => {
        // Delete Password
        this.currentFolder().passwordRecords.remove(password);

        this.closePopup();
    };

    deleteFolder = folder => {
        // Delete Folder
        let parentFolders = [];
        if (this.currentFolder() === null) {
            parentFolders = this.folders;
        } else {
            parentFolders = this.currentFolder().childrenFolders;
        }

        parentFolders.remove(folder);

        this.closePopup();
    };
}

export default MainViewModel;
