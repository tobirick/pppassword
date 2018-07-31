@extends('partials.layout') 
@section('title', $Lang->getTranslation('Passwords')) 
@section('content')
    @include('popups.delete-folder')
    @include('popups.delete-password')
    @include('popups.edit-folder')
    @include('popups.edit-password')
    @include('popups.new-folder')
    @include('popups.new-password')
    @include('popups.view-password')

<div class="content-header">
    <h1>{{$Lang->getTranslation('Passwords')}}</h1>
    <div class="password-buttons">
        <div>
            <button data-bind="click: $root.openNewPasswordPopup, clickBubble: false" class="button button--primary">New Password</button>
        </div>
        <button data-bind="click: $root.openNewFolderPopup, clickBubble: false" class="button button--transparent button--icon"><i class="fal fa-folder"></i> New Folder</button>
    </div>
</div>
<div class="content-box content-box--main mb-0">
    <div class="df">
        <div class="form-icon">
            <i class="fal fa-search"></i>
            <input type="text" class="form-input" placeholder="Search title/name ..." data-bind="textInput: filters.nameTextFilter">
        </div>
        <div class="open-filter" data-bind="click: toggleFilter, css: {'open-filter--selected': filterOpen(), 'open-filter--active-filter': filterActive()}">
            <span class="open-filter__text">Filter</span>
            <span class="open-filter__icon"><i class="fal fa-filter"></i></span>
        </div>
    </div>
    <div class="filter" data-bind="with: filters, css: {'filter--open': filterOpen()}">
        <div class="row">
            <div class="col-4" data-bind="with: clientsFilter">
                <div class="tags">
                    <div class="tags__wrapper" data-bind="foreach: clients">
                        <div class="tags__item">
                            <span data-bind="text: name"></span>
                            <span class="cursor-p" data-bind="click: $root.deleteClientFromFilter"><i class="fal fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-dropdown">
                    <input placeholder="Clients ..." type="text" data-bind="textInput: textFilter" class="form-input">
                    <div data-bind="foreach: $root.filteredClientsForFilter" class="form-dropdown__dropdown">
                        <div class="form-dropdown__item" data-bind="click: $root.addClientToFilter">
                            <span data-bind="text: name"></span>
                        </div>
                    </div>
                    <div class="form-dropdown__dropdown form-dropdown__dropdown--empty" data-bind="if: $root.filteredClientsForFilter().length === 0, visible: $root.filteredClientsForFilter().length === 0">
                        <div class="empty-state">
                            <span class="empty-state__icon"><i class="fal fa-user-alt-slash"></i></span>
                            <span class="empty-state__text">No Clients/All Clients selected ...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <input type="text" class="form-input" placeholder="Search for tags ..." data-bind="textInput: tagsTextFilter">
            </div>
            <div class="col-4">
                <div class="form-checkbox">
                    <input type="checkbox" data-bind="checked: types" value="folders"> Folders
                </div>
                <div class="form-checkbox">
                    <input type="checkbox" data-bind="checked: types" value="clients"> Clients
                </div>
                <div class="form-checkbox">
                    <input type="checkbox" data-bind="checked: types" value="passwords"> Passwords
                </div>
            </div>
        </div>
    </div>
</div>
<div id="passwords" class="content-box content-box--main loading">
    <div class="breadcrumbs">
        <span class="breadcrumbs__item breadcrumbs__item--home" data-bind="click: $root.setRootFolder">Home <i class="fal fa-angle-right"></i></span>
        <span data-bind="foreach: breadcrumbs">
                <span class="breadcrumbs__item" data-bind="css: {'breadcrumbs__item--active': $root.currentFolder() && id === $root.currentFolder().id}">
                <span data-bind="text: name, click: $root.setCurrentFolder"></span>
        <i class="fal fa-angle-right"></i>
        </span>
        </span>
    </div>

    <div data-bind="if: !currentFolder() && $root.filters.types().includes('folders')">
        <div data-bind="foreach: filteredFolders">
            <div class="folder-item" data-bind="click: $root.setCurrentFolder, visible: ($root.filters.types().includes('clients') && isClient()) || !isClient()">
                <div class="folder-item__icon" data-bind="if: isClient(), visible: isClient()"><i class="fal fa-user"></i></div>
                <div class="folder-item__icon" data-bind="if: !isClient(), visible: !isClient()"><i class="fal fa-folder"></i></div>
                <span class="folder-item__title" data-bind="text: name"></span>
                <div class="folder-item__edit">
                    <span data-bind="click: toggleDropdownMenu, clickBubble: false" class="folder-item__edit-icon">
                        <i class="fal fa-ellipsis-h"></i>
                    </span>
                    <div data-bind="css: {'folder-item__dropdown--open': dropdownMenuOpen()}" class="folder-item__dropdown">
                        <div data-bind="click: $root.openEditFolderPopup, clickBubble: false" class="folder-item__dropdown-item">
                            <i class="fal fa-pencil"></i> Edit
                        </div>
                        <div data-bind="click: $root.openDeleteFolderPopup, clickBubble: false" class="folder-item__dropdown-item">
                            <i class="fal fa-trash"></i> Delete
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div data-bind="with: currentFolder">
        <div data-bind="if: isClient(), visible: isClient()" class="client-info">
            <div data-bind="with: clientDetails">
                <div><strong>E-Mail:</strong> <span data-bind="text: email"></span></div>
                <div><strong>Phone:</strong> <span data-bind="text: phone"></span></div>
                <div><strong>Mobile Phone:</strong> <span data-bind="text: mobilePhone"></span></div>
                <div><strong>Notes:</strong> <span data-bind="text: notes"></span></div>
                <div><strong>City:</strong> <span data-bind="text: city"></span></div>
                <div><strong>PLZ:</strong> <span data-bind="text: plz"></span></div>
                <div><strong>Street:</strong> <span data-bind="text: street"></span></div>
            </div>
        </div>

        <hr class="mt-4 mb-4">

        <div data-bind="if: $root.filteredPasswords().length > 0 && $root.filters.types().includes('passwords')">
            <h2>Passwords</h2>
            <div data-bind="foreach: $root.filteredPasswords">
                <div class="password-item" data-bind="click: $root.openPasswordPopup">
                    <div class="password-item__icon"><i class="fal fa-key"></i></div>
                    <span class="password-item__title" data-bind="text: title"></span>
                    <div class="password-item__edit">
                        <span data-bind="click: toggleDropdownMenu, clickBubble: false" class="password-item__edit-icon">
                            <i class="fal fa-ellipsis-h"></i>
                        </span>
                        <div data-bind="css: {'folder-item__dropdown--open': dropdownMenuOpen()}" class="password-item__dropdown">
                            <div data-bind="click: $root.openEditPasswordPopup, clickBubble: false" class="password-item__dropdown-item">
                                <i class="fal fa-pencil"></i> Edit
                            </div>
                            <div data-bind="click: $root.openDeletePasswordPopup, clickBubble: false" class="password-item__dropdown-item">
                                <i class="fal fa-trash"></i> Delete
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-2 mb-2">
        </div>

        <div data-bind="if: $root.filteredFolders().length > 0 && $root.filters.types().includes('folders')">
            <h2>Subfolders</h2>
            <div data-bind="foreach: $root.filteredFolders">
                <div class="folder-item" data-bind="click: $root.setCurrentFolder, visible: ($root.filters.types().includes('clients') && isClient()) || !isClient()">
                    <div class="folder-item__icon" data-bind="if: isClient(), visible: isClient()"><i class="fal fa-user"></i></div>
                    <div class="folder-item__icon" data-bind="if: !isClient(), visible: !isClient()"><i class="fal fa-folder"></i></div>
                    <span class="folder-item__title" data-bind="text: name"></span>
                    <div class="folder-item__edit">
                        <span data-bind="click: toggleDropdownMenu, clickBubble: false" class="folder-item__edit-icon">
                            <i class="fal fa-ellipsis-h"></i>
                        </span>
                        <div data-bind="css: {'folder-item__dropdown--open': dropdownMenuOpen()}" class="folder-item__dropdown">
                            <div data-bind="click: $root.openEditFolderPopup, clickBubble: false" class="folder-item__dropdown-item">
                                <i class="fal fa-pencil"></i> Edit
                            </div>
                            <div data-bind="click: $root.openDeleteFolderPopup, clickBubble: false" class="folder-item__dropdown-item">
                                <i class="fal fa-trash"></i> Delete
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

        </div>
    </div>
</div>







@stop