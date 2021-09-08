import * as myModule from './module.js';

//add comment ajax
let addCommentForm = document.getElementById('add_comment');


myModule.ajaxPostProcess(addCommentForm, ['website']);
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
//delete post ajax
let deleteCommentTargets = Array.from(document.querySelectorAll('.delete-comment-ajax'));

myModule.ajaxDelete(deleteCommentTargets, 'Are you sure Delete this Comment ?');
//delete post ajax

//editComment
let editCommentButtons = Array.from(document.querySelectorAll('.edit-comment-ajax-button'));

myModule.editComment(editCommentButtons);
//editComment