<div class="popup popup--edit-folder hidden" data-bind="with: $root.selectedFolder, visibleFade: $root.editFolderPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2>Edit folder "<span data-bind="text: name"></span>"</h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: name" placeholder="Name">
            </div>
            <div data-bind="if: isClient() && clientDetails">
                    <div class="form-row">
                        <input class="form-input" type="email" data-bind="value: clientDetails.email" placeholder="E-Mail">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails.phone" placeholder="Phone Number">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails.mobilePhone" placeholder="Mobile Phone Number">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails.city" placeholder="City">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails.plz" placeholder="PLZ">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails.street" placeholder="Street">
                    </div>
                    <div class="form-row">
                        <textarea class="form-input" placeholder="Notes" data-bind="value: clientDetails.notes"></textarea>
                    </div>
            </div>
            <button class="button button--primary button--block" data-bind="click: $root.updateFolder">Update folder</button>
        </div>
    </div>
</div>