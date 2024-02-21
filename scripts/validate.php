<script>
    const fullname = document.getElementById('fullname');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const address = document.getElementById('address');

    const errorFullname = document.getElementById('errorFullname');
    const errorUsername = document.getElementById('errorUsername');
    const errorEmail = document.getElementById('errorEmail');
    const errorPassword = document.getElementById('errorPassword');
    const errorAddress = document.getElementById('errorAddress');
    const errorSubmit = document.getElementById('errorSubmit');

    const fullnameRx = /^[a-zA-Z\s]{3,}$/;
    const usernameRx = /^[a-zA-Z0-9_]{3,12}$/;
    const emailRx = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRx = /^(?=.*\d)[^\s]{8,16}$/;

    function ValidateRegister(e) {
        if (!fullnameRx.test(fullname.value) || !usernameRx.test(username.value)
            || !emailRx.test(email.value) || !passwordRx.test(password.value)
            || fullname.value.length == 0 || username.value.length == 0
            || email.value.length == 0 || address.value.length == 0 || password.value.length == 0) {
            e.preventDefault();
        }
        if (fullname.value.length == 0) {
            errorFullname.innerHTML = "Fullname cannot be empty"
            errorFullname.classList.remove("hidden");
        }
        if (address.value.length == 0) {
            errorAddress.innerHTML = "Address cannot be empty"
            errorAddress.classList.remove("hidden");
        }
        if (username.value.length == 0) {
            errorUsername.innerHTML = "Username cannot be empty"
            errorUsername.classList.remove("hidden");
        }
        if (email.value.length == 0) {
            errorEmail.innerHTML = "Email cannot be empty"
            errorEmail.classList.remove("hidden");
        }
        if (password.value.length == 0) {
            errorPassword.innerHTML = "Password cannot be empty"
            errorPassword.classList.remove("hidden");
        }
    }

    function ValidateLogin(e) {
        if (!emailRx.test(email.value) || !passwordRx.test(password.value)
            || email.value.length == 0 || password.value.length == 0) {
            e.preventDefault();
        }
        if (email.value.length == 0) {
            errorEmail.innerHTML = "Email cannot be empty"
            errorEmail.classList.remove("hidden");
        }
        if (password.value.length == 0) {
            errorPassword.innerHTML = "Password cannot be empty"
            errorPassword.classList.remove("hidden");
        }

    }
    function Validate(string) {
        if (string == "fullname") {
            if (!fullnameRx.test(fullname.value) && fullname.value.length > 0) {
                errorFullname.innerHTML = "Fullname must be at least 3 characters long, without numbers or symbols."
                errorFullname.classList.remove("hidden");
            } else if (fullname.value.length > 0) {
                errorFullname.classList.add("hidden");
            }
        }
        if (string == "username") {
            if (!usernameRx.test(username.value) && username.value.length > 0) {
                errorUsername.innerHTML = "Username must have 3-12 characters, cannot contain symbols other than underscore and should not use spaces."
                errorUsername.classList.remove("hidden");
            } else if (username.value.length > 0) {
                errorUsername.classList.add("hidden");
            }
        }
        if (string == "email") {
            if (!emailRx.test(email.value) && email.value.length > 0) {
                errorEmail.innerHTML = "Invalid email address. Please enter a valid email."
                errorEmail.classList.remove("hidden");
            } else if (email.value.length > 0) {
                errorEmail.classList.add("hidden");
            }
        }
        if (string == "password") {
            if (!passwordRx.test(password.value) && password.value.length > 0) {
                errorPassword.innerHTML = "Password must have 8-16 characters, must contain at least one number and no spaces."
                errorPassword.classList.remove("hidden");
            } else if (password.value.length > 0) {
                errorPassword.classList.add("hidden");
            }
        }
        if (string == "address") {
            if (address.value.length > 0) {
                errorAddress.classList.add("hidden");
            }
        }
    }
    function SubmitError() {
        errorSubmit.classList.remove("hidden");
    }
    function SubmitCustomError(string) {
        errorSubmit.innerHTML = string;
        errorSubmit.classList.remove("hidden");
    }

    function ValidateProfile(e) {
        if (!fullnameRx.test(fullname.value) || !usernameRx.test(username.value) || address.value.length == 0) {
            e.preventDefault();
        }
        if (fullname.value.length == 0) {
            errorFullname.innerHTML = "Fullname cannot be empty"
            errorFullname.classList.remove("hidden");
        }
        if (address.value.length == 0) {
            errorAddress.innerHTML = "Address cannot be empty"
            errorAddress.classList.remove("hidden");
        }
        if (username.value.length == 0) {
            errorUsername.innerHTML = "Username cannot be empty"
            errorUsername.classList.remove("hidden");
        }
    }
</script>