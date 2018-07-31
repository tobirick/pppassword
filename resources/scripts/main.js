"use strict";

// CSS Files
import "../styles/main.scss";

// Settings
import "./helpers/utils/axiosDefaultSettings";

// View Models
import ko from "knockout";
import PasswordMainViewModel from "./Passwords/MainViewModel";

const pathName = window.location.pathname;

ko.bindingHandlers.visibleFade = {
    init: function(element, valueAccessor) {
        element.classList.add("hidden");
    },
    update: function(element, valueAccessor) {
        // Whenever the value subsequently changes, slowly fade the element in or out
        const value = valueAccessor();
        ko.utils.unwrapObservable(value)
            ? element.classList.remove("hidden")
            : element.classList.add("hidden");
    }
};

if (pathName.includes("/dashboard")) {
    const passwordMainViewModel = new PasswordMainViewModel();
    passwordMainViewModel
        .fetchFolders()
        .then(() => passwordMainViewModel.fetchClients())
        .then(() => {
            ko.applyBindings(passwordMainViewModel);
            document.querySelector('#passwords').classList.remove('loading');
        });
}
