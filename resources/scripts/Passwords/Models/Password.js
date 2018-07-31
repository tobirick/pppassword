import ko from "knockout";

class Password {
    constructor(password = {}) {
        this.id = password.id;
        this.title = ko.observable(password.title).extend({
            required: true
        });
        this.url = password.url;
        this.email = ko.observable(password.email).extend({
            email: true
        });
        this.username = password.username;
        this.password = password.password;
        this.notes = password.notes;

        this.tags = ko.observableArray(password.tags || []);
        this.entryFields = ko.observableArray(password.entry_fields || []);
        this.clients = ko.observableArray(password.clients || []);

        this.newEntryFieldKey = ko.observable('');
        this.newTagValue = ko.observable('');

        this.dropdownMenuOpen = ko.observable(false);
    }

    toggleDropdownMenu = () => {
        this.dropdownMenuOpen(!this.dropdownMenuOpen());
    }

    addEntryField = () => {
        if (this.newEntryFieldKey()) {
            this.entryFields.push({
                field_key: this.newEntryFieldKey(),
                field_value: ""
            });
        }

        this.newEntryFieldKey(null);
    };

    addTag = (data, event) => {
        const code = event.code;
        
        if (code === "Comma") {
            this.tags.push({
                title: this.newTagValue().slice(0, -1)
            });
            this.newTagValue(null);
        }
    };

    deleteTag = tag => {
        this.tags.remove(tag);
    };

    addClient = client => {
        if (this.clients().indexOf(client) === -1) {
            this.clients.push(client);
        }
    };

    deleteClient = client => {
        this.clients.remove(client);
    };
}

export default Password;
