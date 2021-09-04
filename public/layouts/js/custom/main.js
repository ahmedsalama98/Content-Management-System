import * as myModule from './module.js';

//add comment ajax
let addCommentForm = document.getElementById('add_comment');


myModule.ajaxPostProcces(addCommentForm, ['website']);
//add comment ajax
//add Add Contact Messge ajax
let AddContactMessge = document.getElementById('add-contact-message');
myModule.ajaxPostProcces(AddContactMessge, ['mobile']);
//add Add Contact Messge ajax