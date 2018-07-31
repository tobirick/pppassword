<div class="popup popup--view-password hidden" data-bind="with: $root.selectedPassword, visibleFade: $root.viewPasswordPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2 data-bind="text: title"></h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <div><strong>URL:</strong> <span data-bind="text: url"></span></div>
            <div><strong>Username:</strong> <span data-bind="text: username"></span></div>
            <div><strong>Password:</strong> <span data-bind="text: password"></span></div>
            <div><strong>Notes:</strong> <span data-bind="text: notes"></span></div>
            <div data-bind="foreach: entryFields">
                <div><strong data-bind="text: field_key"></strong><strong>:</strong> <span data-bind="text: field_value"></span></div>
            </div>
            <div>
                <strong>Tags:</strong>
                <div class="tags">
                    <div class="tags__wrapper" data-bind="foreach: tags">
                        <div class="tags__item">
                            <span data-bind="text: title"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>