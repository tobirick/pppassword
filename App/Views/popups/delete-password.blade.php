<div class="popup popup--delete-password hidden" data-bind="with: $root.selectedPassword, visibleFade: $root.deletePasswordPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2>Delete password "<span data-bind="text: title"></span>"?</h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <h4>Are you sure you want to delete the password "<span data-bind="text: title"></span>" from this folder?</h4>
            <div class="end-h-flex">
                <button data-bind="click: $root.deletePassword" class="button button--primary mr-2">Yes</button>
                <button data-bind="click: $root.closePopup" class="button button--transparent button--icon"><i class="fal fa-ban"></i> No</button>
            </div>
        </div>
    </div>
</div>