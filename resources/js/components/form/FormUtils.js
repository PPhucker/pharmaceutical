const FormUtils = {
    submitForm: function(formId) {
        const form = document.getElementById(formId);
        const submitButton = document.getElementById('submitButton_' + formId);

        const navLink = document.getElementById('nav-'
            + formId +
            '-tab');

        const spinner = navLink.querySelector('.spinner-border');

        const visibleInputFields = form.querySelectorAll(
            'input:not([type="hidden"]), textarea, select');

        submitButton.disabled = true;

        for (let field of visibleInputFields) {
            field.readOnly = true;
        }

        spinner.classList.remove('d-none');

        form.submit();
    },
    restore: function(route, id) {
        event.preventDefault();

        const formId = route + '-restore-form-' + id;
        const buttonId = 'restore-href-' + id;

        this.spinner(
            buttonId,
        );

        document.getElementById(formId).submit();
    },
    destroy: function(route, id) {
        event.preventDefault();

        const formId = route + '-destroy-form-' + id;
        const buttonId = route + '-destroy-href-' + id;

        this.spinner(
            buttonId,
        );

        document.getElementById(formId).submit();
    },
    spinner: function(elementId) {
        console.log(elementId);
        const spinner = document.getElementById(elementId).
            querySelector('.spinner-border');
        spinner.classList.remove('d-none');
    },
};

window.FormUtils = FormUtils;
