<div class="popup popup--new-password hidden" data-bind="with: $root.newPasswordVM, visibleFade: $root.newPasswordPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2>New Password</h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: title" placeholder="Title">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: url" placeholder="URL">
            </div>
            <div class="form-row">
                <input class="form-input" type="email" data-bind="value: email" placeholder="E-Mail">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: username" placeholder="Username">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: password" placeholder="Password">
            </div>
            <div class="form-row">
                <textarea class="form-input" placeholder="Notes" data-bind="value: notes"></textarea>
            </div>
            <div class="form-row">
                <strong>Additional Fields:</strong>
                <div data-bind="foreach: entryFields">
                    <div class="form-row">
                        <label data-bind="attr: {for: field_key}, text: field_key" class="form-label"></label>
                        <input type="text" class="form-input" data-bind="value: field_value, attr: {id: field_key, placeholder: field_key}">
                    </div>
                </div>
                <div class="df">
                    <input data-bind="value: newEntryFieldKey" type="text" class="form-input mr-2" placeholder="Key">
                    <button data-bind="click: addEntryField" class="button button--primary button--icon"><i class="fal fa-plus"></i> Add</button>
                </div>
            </div>
            <div class="form-row">
                <strong>Clients:</strong>
                <div class="tags">
                    <div class="tags__wrapper" data-bind="foreach: clients">
                        <div class="tags__item">
                            <span data-bind="text: name"></span>
                            <span class="cursor-p" data-bind="click: $parent.deleteClient"><i class="fal fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-dropdown">
                    <input placeholder="Search for clients ..." type="text" data-bind="textInput: $root.clientsFilterValue" class="form-input">
                    <div data-bind="foreach: $root.filteredClients" class="form-dropdown__dropdown">
                        <div class="form-dropdown__item" data-bind="click: $parent.addClient">
                            <span data-bind="text: name"></span>
                        </div>
                    </div>
                    <div class="form-dropdown__dropdown form-dropdown__dropdown--empty" data-bind="if: $root.filteredClients().length === 0, visible: $root.filteredClients().length === 0">
                        <div class="empty-state">
                            <span class="empty-state__icon"><i class="fal fa-user-alt-slash"></i></span>
                            <span class="empty-state__text">No Clients/All Clients selected ...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <strong>Tags:</strong>
                <div class="tags tags--input">
                    <div class="tags__wrapper" data-bind="foreach: tags">
                        <div class="tags__item">
                            <span data-bind="text: title"></span>
                            <span class="cursor-p" data-bind="click: $parent.deleteTag"><i class="fal fa-times"></i></span>
                        </div>
                    </div>
                    <div class="tags__input">
                        <input type="text" class="form-input" data-bind="textInput: newTagValue, event: {'keyup': addTag}">
                    </div>
                </div>
                <span>Press "," to add a new Tag.</span>
            </div>
            <div class="form-row">
                <button data-bind="click: $root.createPasswordRecord" class="button button--primary button--block">Create password</button>
            </div>
        </div>
    </div>
</div>