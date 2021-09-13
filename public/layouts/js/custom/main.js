import * as myModule from './module.js';

//add comment ajax
let addCommentForm = document.getElementById('add_comment');


myModule.ajaxPostProcess(addCommentForm, ['website'], null, true, true);
//add comment ajax
//add Add Contact Messge ajax
let AddContactMessge = document.getElementById('add-contact-message');
myModule.ajaxPostProcess(AddContactMessge, ['mobile']);
//add Add Contact Message ajax

//add post ajax
let addPostForm = document.getElementById('add-post-form');
myModule.ajaxPostProcess(addPostForm, ['images[]', 'images'], closeFileInput);

function closeFileInput() {
    let closFileInputElement = document.querySelector('.fileinput-remove');
    if (closFileInputElement != undefined || closFileInput != null) {
        closFileInputElement.click();
    }
}
//add post ajax

//edit post ajax
let editPostForm = document.getElementById('edit-post-form');
myModule.ajaxPostProcess(editPostForm, ['images[]', 'images'], null, false);
//edit post ajax



//delete post ajax
let deletePostTargets = Array.from(document.querySelectorAll('.ajax-delete-confirm'));

myModule.ajaxDelete(deletePostTargets, 'Are you sure Delete this Post ?');
//delete post ajax

//regaularDelete

let deletePostFromPostPage = document.getElementById('regular-delete-post');

myModule.regaularDelete(deletePostFromPostPage, 'Are you sure Delete this post');

//regaularDelete
//delete comment ajax

let deleteCommentTargets = Array.from(document.querySelectorAll('.delete-comment-ajax'));

myModule.ajaxDelete(deleteCommentTargets, 'Are you sure Delete this Comment ?');
//delete comment ajax

//editComment
let editCommentButtons = Array.from(document.querySelectorAll('.edit-comment-ajax-button'));

myModule.editComment(editCommentButtons);
//editComment

//update info ajax
let updateInfoForm = document.getElementById('update-info-form');
myModule.ajaxPostProcess(updateInfoForm, ['mobile', 'bio', 'profile-image'], null, false);
//update info ajax

//update password ajax
let updatePasswordForm = document.getElementById('update-password-form');
myModule.ajaxPostProcess(updatePasswordForm, [], null, true);
//update password ajax