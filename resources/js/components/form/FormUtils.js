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
};

window.FormUtils = FormUtils;
