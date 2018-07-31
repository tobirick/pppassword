<div class="popup popup--delete-folder hidden" data-bind="with: $root.selectedFolder, visibleFade: $root.deleteFolderPopupOpen">
    <div class="popup__container">
        <div class="popup__header">
            <h2>Delete folder "<span data-bind="text: name"></span>"</h2>
            <span class="popup__close" data-bind="click: $root.closePopup">
                    <i class="fal fa-times"></i>
                </span>
        </div>
        <div class="popup__content">
            <h4>Are you sure you want to delete the folder "<span data-bind="text: name"></span>" and all his containing children?</h4>
            <div class="end-h-flex">
                <button data-bind="click: $root.deleteFolder" class="button button--primary mr-2">Yes</button>
                <button data-bind="click: $root.closePopup" class="button button--transparent button--icon"><i class="fal fa-ban"></i> No</button>
            </div>
        </div>
    </div>
</div>