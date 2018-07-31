import ko from "knockout";

import Client from "./Client";
import Password from "./Password";

class Folder {
    constructor(folder = {}) {
        this.id = folder.id;
        this.name = ko.observable(folder.name).extend({ required: true });
        this.position = folder.position;
        this.childrenFolders = ko.observableArray([]);
        this.passwordRecords = ko.observableArray([]);

        this.clientDetails = ko.validatedObservable(null);
        this.isClient = ko.observable(!!Number(folder.is_client));

        if (this.isClient()) {
            this.clientDetails(new Client(folder));
        }

        this.hasChildren =
            folder.children_folders && !!folder.children_folders.length;
        this.hasPasswordRecords =
            folder.password_records && !!folder.password_records.length;

        if (this.hasChildren) {
            const childrenFolders = ko.utils.arrayMap(
                folder.children_folders,
                folder => new Folder(folder)
            );
            this.childrenFolders(childrenFolders);
        }

        if (this.hasPasswordRecords) {
            const passwordRecords = ko.utils.arrayMap(
                folder.password_records,
                passwordRecord => new Password(passwordRecord)
            );
            this.passwordRecords(passwordRecords);
        }

        this.isClient.subscribe(() => {
            if (this.isClient() && this.clientDetails() === null) {
                this.clientDetails(new Client(folder));
            } else {
                this.clientDetails(null);
            }
        });

        this.dropdownMenuOpen = ko.observable(false);
    }

    toggleDropdownMenu = () => {
        this.dropdownMenuOpen(!this.dropdownMenuOpen());
    };
}

export default Folder;
