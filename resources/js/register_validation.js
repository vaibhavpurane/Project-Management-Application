
$(document).ready(function () {
    $('.submit').click(function (e) {
        $('.error-message').text('');
        var isValid = true;
        var name = $('#name').val().trim();
        if(name === ''){
            $('#name').siblings('.error-message').text('Please enter your name');
            isValid=false;
        }
        var email=$('#email').val().trim();
        if(email === ''){
            $('#email').siblings('.error-message').text('Please enter your email address');
            isValid=false;
        }else if(!isValidEmail(email)){
            $('#email').siblings('.error-message').text('Please, enter valid email address');
            isValid=false;
        }
        var phone = $('#phone').val();
        if(phone === ''){
            $('#phone').siblings('.error-message').text('Please enter your phone');
            isValid=false;
        }else if(!isValidPhone(phone)){
            $('#phone').siblings('.error-message').text('Please, enter your valid phone');
            isValid=false;
        }
        var password = $('#password').val();
        if (password === '') {
            $('#password').siblings('.error-message').text('Please enter your password');
            isValid = false;
        }else if(!isValidPassword(password)){
            $('#password').siblings('.error-message').text('Your password must be at least 8 characters long');
            isValid = false;
        }
        var passwordConfirm = $('#password-confirm').val();
        if (password !== passwordConfirm) {
            $('#password-confirm').siblings('.error-message').text('Password confirmation must match the password');
            isValid = false;
        }

        if(!isValid){
            e.preventDefault();
        }
    })
    function isValidEmail(email){
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    function isValidPhone(phone){
        var phonePattern = /^[0-9]{10}$/;
        return phonePattern.test(phone);
    }
    function isValidPassword(password){
        var passwordPattern = /^.{8}$/;
        return passwordPattern.test(password);
    }
})
