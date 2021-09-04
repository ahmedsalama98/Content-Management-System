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



let actions = Array.from(document.querySelectorAll('.confirm_action'));

let targetForm = document.querySelector('.confirm_action');

actions.forEach(action => {

    action.addEventListener('submit', (event) => {

        event.preventDefault();
        createConfirmElements()
        targetForm = event.currentTarget;
        console.log(target)

    });
});

document.addEventListener('click', function(event) {
    if (event.target.dataset.confirm == 'yes') {
        targetForm.submit()
    } else if (event.target.dataset.confirm == 'no') {

        document.getElementById('confirm_container').remove();
    }
});


function createConfirmElements(message = ' Are you sure to delet it ? ') {
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

function ajaxPostProcces(formTagrt, skipedfieldsArray) {

    if (formTagrt == null) {
        return
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
                        cleanFields(that, skipedfieldsArray)
                        notfy(response.message, 'success', 4000);
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
function cleanFields(formTagrt, skipedfieldsArray) {
    let fields = Array.from(formTagrt.querySelectorAll('.field'));
    fields.forEach(field => {
        let fieldName = field.name;
        let skip = false;
        field.value = '';
        field.innerHTML = '';
        skipedfieldsArray.forEach(skipone => {
            if (fieldName == skipone) {
                skip = true;
            }
        });
        if (skip === true) {
            return
        }
        document.querySelector('#' + fieldName + '-error').innerHTML = '';

    });

}


export { ajaxPostProcces, notfy };
//ajax post procces