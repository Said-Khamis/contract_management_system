let varyingContentModal = document.getElementById('varyingContentModal')

window.getGeneralFormModal = function (){
    varyingContentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget

        //form to be rendered
        let formView = button.getAttribute('data-bs-form');
        let formAction = button.getAttribute('data-bs-form-action');
        let title = button.getAttribute('data-bs-title');
        let formMethod = button.getAttribute('data-bs-method');


        // Update the modal's content.
        let modalBody = varyingContentModal.querySelector('.modal-body');
        let modalHeader = varyingContentModal.querySelector('.modal-title');
        let form = varyingContentModal.querySelector('.general-form');

        form.setAttribute('action',formAction);
        form.setAttribute('method',formMethod);
        modalHeader.textContent = title

        $('.modal-body').load(formView);

        $('#editOnShow').on("click", reInjectModalContent());
    })
}

window.reInjectModalContent = function () {
    // Button that triggered the modal
    let button = event.relatedTarget

    //form to be rendered
    let formView = button.getAttribute('data-bs-form');
    let formAction = button.getAttribute('data-bs-form-action');
    let title = button.getAttribute('data-bs-title');
    let formMethod = button.getAttribute('data-bs-method');


    // Update the modal's content.
    let modalBody = varyingContentModal.querySelector('.modal-body');
    let modalHeader = varyingContentModal.querySelector('.modal-title');
    let form = varyingContentModal.querySelector('.general-form');

    form.setAttribute('action',formAction);
    form.setAttribute('method',formMethod);
    modalHeader.textContent = title

    $('.modal-body').load(formView);
}

