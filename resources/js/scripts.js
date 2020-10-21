$(document).ready(function () {
    const wrapperElem = $('.wrapper');
    const postCreateForm = $('.post-create__form');
    const feedbackCreateForm = $('.feedback__form');

    postCreateForm.on('submit', function (event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
        }

        this.classList.add('was-validated');
    });

    feedbackCreateForm.on('submit', function (event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
        }

        this.classList.add('was-validated');
    });
});
