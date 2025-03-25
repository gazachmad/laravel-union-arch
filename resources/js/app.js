import './bootstrap';
import feather from 'feather-icons';

window.feather = feather;

feather.replace();

document.addEventListener('DOMContentLoaded', () => {
    const togglePasswordButtons = document.querySelectorAll('button[data-action="toggle-password"]');

    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', togglePassword);
    });
});

function togglePassword(event) {
    event.preventDefault();

    const inputPassword = this.previousElementSibling;

    if (inputPassword.type === 'password') {
        inputPassword.type = 'text';
        this.children[0].dataset.feather = 'eye-off';
    } else {
        inputPassword.type = 'password';
        this.children[0].dataset.feather = 'eye';
    }

    feather.replace();
}