//jquery
$(function() {


        $('.alert').alert()

    })
    //jquery

// notfy
let notifyOffset = 100;
let notfyTimeOut;

function notfy(message = 'done', style = 'primary', duration = 4000) {

    let notfy = document.createElement('div');
    notfy.className = 'notify ' + style;
    notfy.style.top = notifyOffset + 'px';
    notfy.innerHTML = message;
    notifyOffset += 50;
    document.body.appendChild(notfy);

    notfyTimeOut = setTimeout(function() {

        notfy.classList.add('bye');
        notifyOffset -= 50;
    }, duration)


}
document.addEventListener('click', function(e) {

    if (e.target.classList.contains('notify')) {
        e.target.classList.add('bye');
    }
});
// notfy

//confirm



// let actions = Array.from(document.querySelectorAll('.confirm_action'));

// let targetForm = document.querySelector('.confirm_action');

// actions.forEach(action => {

//     action.addEventListener('submit', (event) => {

//         event.preventDefault();
//         createConfirmElements()
//         targetForm = event.currentTarget;
//         console.log(target)

//     });
// });




function createConfirmElements(message) {
    /*  let confirmElements = `<div class="confirm_container" id="confirm_container" style="display: none">
                              <div class="content">
                              <div class="message">
                                  ${message}
                              </div>
                              <div class="actions">
                                  <button data-confirm="yes" class="btn btn-danger"> yes </button>
                                  <button data-confirm="no" class="btn btn-primary"> no </button>
                              </div>
                              </div>
                              </div>
                              `;*/

    let confirmCotainer = document.createElement('div'),
        confirmContent = document.createElement('div'),
        confirmMessge = document.createElement('div'),
        confirmActions = document.createElement('div'),
        confirmYes = document.createElement('button'),
        confirmNo = document.createElement('button');
    /////
    confirmCotainer.id = 'confirm_container';
    confirmCotainer.className = 'confirm_container';
    confirmContent.className = 'content';
    confirmMessge.className = 'message';
    confirmMessge.innerHTML = message;
    confirmActions.className = 'actions';
    confirmYes.dataset.confirm = 'yes';
    confirmYes.className = 'btn btn-danger';
    confirmYes.innerHTML = 'yes';
    confirmNo.dataset.confirm = 'no';
    confirmNo.className = 'btn btn-primary';
    confirmNo.innerHTML = 'no';
    //////////
    confirmActions.appendChild(confirmYes);
    confirmActions.appendChild(confirmNo);
    confirmContent.appendChild(confirmMessge);
    confirmContent.appendChild(confirmActions);
    confirmCotainer.appendChild(confirmContent);
    document.body.appendChild(confirmCotainer);
}
//confirm

//ajax post procces

let ajaxproces = true;

function ajaxPostProcess(formTagrt, skipedfieldsArray = [], callback = null, cleanAfter = true, addCommnetMode = false, ) {

    if (formTagrt == null) {
        return
    }

    const addComment = (comment, profileimage, csrf, deleteLink, editLink) => {



        let commnetsContainer = document.getElementById('commnets-container'),
            oldComments = commnetsContainer.innerHTML;
        let newcomment = `<li>
        <div class="wn__comment" id="parent-id-${comment.id}">
            <div class="thumb">

            <img  style="border-radius: 50%" src="${profileimage}" alt="comment images">


            </div>
            <div class="content">
                <div class="comnt__author d-block d-sm-flex">
                    <span><a href="#">
                        ${comment.name}

                    </a> </span>
                    <span>Now</span>

                </div>
                <P class="comment-comment">  ${comment.comment}</P>


                <div class="comment_owner_controle">
                    <div class="open_button"> <i class="fa fa-ellipsis-v"></i> </div>

                    <div class="actions">
                        <button  data-parentid="${comment.id}"  data-csrf="${csrf}" data-oldcomment="${comment.comment}" data-url="comment/${comment.id}/update" class="btn btn-primary edit-comment-ajax-button" >Edit Comment <i class="fa fa-edit"></i></button>
                        <form method="POST" data-parentid="${comment.id}"  class="delete-comment-ajax"  action="comment/${comment.id}/destroy">
                            <input  type="hidden" name="_token" value="${csrf}">
                            <input  type="hidden" name="_method" value="DELETE">
                            <button  type="submit" class="btn btn-danger d-block btn-block"> Delete Comment <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>

            </div>
</div></li>`;




        commnetsContainer.innerHTML = newcomment + oldComments;

        let editCommentButtons = Array.from(document.querySelectorAll('.edit-comment-ajax-button'));
        editComment(editCommentButtons);

        let deleteCommentTargets = Array.from(document.querySelectorAll('.delete-comment-ajax'));

        ajaxDelete(deleteCommentTargets, 'Are you sure Delete this Comment ?');


        let commentsCount = document.getElementById('comments_count');

        commentsCount.innerHTML = parseInt(commentsCount.innerHTML) + 1;



    }
    formTagrt.addEventListener('submit', (event) => {
        event.preventDefault();
        let that = event.currentTarget;
        const validat = checkImptyFields(that, skipedfieldsArray);

        if (validat === true && ajaxproces === true) {

            let ajaxForm = new FormData(event.currentTarget);
            let url = event.currentTarget.action;
            ajaxproces = false;
            fetch(url, {
                    method: 'Post',
                    body: ajaxForm
                })
                .then(response => response.json())
                .then(response => {
                    ajaxproces = true;

                    if (response.success == true) {
                        if (cleanAfter == true) {
                            cleanFields(that)
                        } else {
                            cleanFields(that, true)
                        }
                        notfy(response.message, 'success', 4000);


                        if (addCommnetMode == true) {
                            let profileImage = that.dataset.profileimage,
                                csrf = that.dataset.csrf;
                            addComment(response.data, profileImage, csrf);
                        }
                        if (callback != null) {
                            callback()
                        }
                    } else {

                        let errors = response.errors;
                        for (let key in errors) {
                            let fieldName = key;
                            let errorMessgeElement = document.querySelector('#' + fieldName + '-error');

                            if (errorMessgeElement != null) {
                                errorMessgeElement.innerHTML = '';
                                errors[key].forEach(error => {
                                    errorMessgeElement.innerHTML += ` ${ error} </br>`;
                                })
                            }
                        }
                        notfy(response.message, 'danger', 4000);
                    }

                    console.log(response)
                });

        }



    });
}
//check impty form fields
function checkImptyFields(formTagrt, skipedfieldsArray) {
    let validation = true;
    let fields = Array.from(formTagrt.querySelectorAll('.field'));
    fields.forEach(field => {
        let fieldName = field.name;

        if (fieldName.endsWith('[]')) {

            let splitedName = fieldName.split('[');
            fieldName = splitedName[0];



        }
        let skip = false;
        skipedfieldsArray.forEach(skipone => {
            if (fieldName == skipone) {
                skip = true;
            }
        });


        if (skip === true) {
            return
        }
        if (field.value.trim() == '') {

            validation = false;
            document.querySelector('#' + fieldName + '-error').innerHTML = fieldName + ' is required';
        } else {

            document.querySelector('#' + fieldName + '-error').innerHTML = ''
        }
    });
    return validation;
}
//check clean form fields value
function cleanFields(formTagrt, onlyErrors = false) {
    let fields = Array.from(formTagrt.querySelectorAll('.field'));
    fields.forEach(field => {
        let fieldName = field.name;
        let skip = false;
        if (onlyErrors == false) {
            if (!field.tagName == 'SELECT') {
                field.innerHTML = '';
            }

            if (field.type != 'checkbox') {
                field.value = '';
            } else if (field.type == 'checkbox') {
                field.checked = false;
            }

        }

        let errorField = document.getElementById(fieldName + '-error');
        if (errorField != null || errorField != undefined) {
            errorField.innerHTML = '';
        }


    });

}



function ajaxDelete(deleleteTargets = [], confirmMessge = ' Are you sure to delet it ? ') {



    deleleteTargets.forEach(targetForm => {

        targetForm.addEventListener('submit', function(event) {
            event.preventDefault()
            createConfirmElements(confirmMessge)

            let form = event.target;

            let actionForm = new FormData(form),
                url = form.action,
                parentId = form.dataset.parentid,
                parentElemnt = document.getElementById('parent-id-' + parentId);


            //close the confirm
            const deleteConfirmContainer = () => {

                if (document.body.contains(document.getElementById('confirm_container'))) {
                    document.getElementById('confirm_container').remove()
                }

            }

            //ajax fetch
            const deleteFetch = async() => {

                fetch(url, {
                        method: 'Post',
                        body: actionForm
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success == true) {
                            notfy(response.message, 'success', 4000);
                            parentElemnt.remove();

                        } else {

                            notfy(response.message, 'danger', 4000);
                        }
                        deleteConfirmContainer();

                        console.log(response)
                    });

            }

            // the choosen action yes or not
            const deleteChosenAction = (event) => {
                    if (event.target.dataset.confirm == 'yes') {
                        deleteFetch();
                        document.body.removeEventListener('click', deleteChosenAction);
                    } else if (event.target.dataset.confirm == 'no') {

                        document.body.removeEventListener('click', deleteChosenAction);
                        return deleteConfirmContainer();
                    }
                }
                //click on yes or no listner
            let clickConfirm = document.body.addEventListener('click', deleteChosenAction);


        })

    })

}


function regaularDelete(deleteForm, confirmMessge = ' Are you sure to delet it ? ') {


    if (deleteForm == null || deleteForm == undefined) {
        return
    }

    deleteForm.addEventListener('submit', function(event) {
        event.preventDefault()
        createConfirmElements(confirmMessge)

        let form = event.target;

        //close the confirm
        const deleteConfirmContainer = () => {

            if (document.body.contains(document.getElementById('confirm_container'))) {
                document.getElementById('confirm_container').remove()
            }

        }

        // the choosen action yes or not
        const deleteChosenAction = (event) => {
                if (event.target.dataset.confirm == 'yes') {
                    form.submit();
                } else if (event.target.dataset.confirm == 'no') {

                    document.body.removeEventListener('click', deleteChosenAction);
                    return deleteConfirmContainer();
                }
            }
            //click on yes or no listner
        let clickConfirm = document.body.addEventListener('click', deleteChosenAction);


    })


}


function editComment(editCommentButtons = []) {

    if (editCommentButtons == null || editCommentButtons == undefined) {
        return
    }
    const createEditCommentForm = (oldComment, csrf_token, formAction, parentId) => {

            let elements = `
        <div class="edit-comment-from-post" id="edit-comment-from-post">

            <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">

                           <div class="content">
                           <div class="close-me"  id="close-edit-comment-button">x</div>
                                <form  action="${formAction}"  method="POST" id="edit-comment-form" data-parentid="${ parentId }">
                                        <input type="hidden" name="_token"  value="${csrf_token}">
                                        <input type="hidden" name="_method"  value="PUT">

                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <textarea id="edit-comment-comment" name="comment" class="form-control" id="comment" cols="15" rows="5">${oldComment}</textarea>

                                        </div>
                                        <div class="edit-post-errors text-danger">
                                        </div>

                                        <div class="form-group mt--20">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                </form>


                           </div>


                        </div>
                </div>
            </div>
        </div>
        `;

            document.getElementById('appneds-component').innerHTML = elements;

        }
        //end create elements


    const editFormAjax = async(event) => {

        event.preventDefault();
        let formData = new FormData(event.target),
            url = event.target.action,
            peretId = event.target.dataset.parentid,
            newcommentvalue = document.getElementById('edit-comment-comment').value;


        fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then((response) => {
                if (response.success == true) {
                    document.getElementById('appneds-component').innerHTML = '';
                    let parent = document.getElementById('parent-id-' + peretId),
                        commentField = parent.querySelector('.comment-comment'),
                        actionButton = parent.querySelector('.edit-comment-ajax-button');
                    commentField.innerHTML = newcommentvalue;
                    actionButton.dataset.oldcomment = newcommentvalue;
                    notfy(response.message, 'success');

                } else {


                    let errors = response.errors,
                        errorMessageContainer = document.querySelector('.edit-post-errors');
                    errorMessageContainer.innerHTML = '';
                    for (let key in errors) {

                        console.log(errorMessageContainer)
                        errorMessageContainer.innerHTML += errors[key][0] + '</br>';

                    }

                }

                console.log(response)
            })



    }

    const closeEditform = () => {

        document.getElementById('close-edit-comment-button').addEventListener('click', () => {
            document.getElementById('appneds-component').innerHTML = '';
        })
    }

    editCommentButtons.forEach((button) => {

        const clickEventFunction = (event) => {
            let url = event.target.dataset.url,
                oldcomment = event.target.dataset.oldcomment,
                csrf = event.target.dataset.csrf,
                parentId = event.target.dataset.parentid;

            createEditCommentForm(oldcomment, csrf, url, parentId);

            let editForm = document.getElementById('edit-comment-form');

            editForm.addEventListener('submit', editFormAjax)
            closeEditform()


        }

        let editEvent = button.addEventListener('click', clickEventFunction);

    })





}

export { ajaxPostProcess, notfy, ajaxDelete, regaularDelete, editComment };
//ajax post procces