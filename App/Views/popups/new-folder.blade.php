<div class="popup popup--new-folder hidden" data-bind="with: $root.newFolderVM, visibleFade: $root.newFolderPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2>New Folder</h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <div class="form-row">
                <input class="form-input" type="text" data-bind="value: name" placeholder="Name">
            </div>
            <div class="form-row">
                <label for="isClient">Client</label>
                <input id="isClient" type="checkbox" data-bind="checked: isClient">
            </div>
            <div data-bind="if: isClient() && clientDetails()">
                    <div class="form-row">
                        <input class="form-input" type="email" data-bind="value: clientDetails().email" placeholder="E-Mail">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails().phone" placeholder="Phone Number">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails().mobilePhone" placeholder="Mobile Phone Number">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails().city" placeholder="City">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails().plz" placeholder="PLZ">
                    </div>
                    <div class="form-row">
                        <input class="form-input" type="text" data-bind="value: clientDetails().street" placeholder="Street">
                    </div>
                    <div class="form-row">
                        <textarea class="form-input" placeholder="Notes" data-bind="value: clientDetails().notes"></textarea>
                    </div>
            </div>
            <button class="button button--primary button--block" data-bind="click: $root.createFolder">Create</button>
        </div>
    </div>
</div>