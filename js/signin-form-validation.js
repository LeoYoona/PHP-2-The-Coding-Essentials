// const name = document.getElementById('name')
// const form = document.getElementById('form')
// const errorElement = document.getElementById('error')
// form.addEventListener('submit', (e) => {
//         let messages = []

//         if (password.value.length <= 6) {
//             messages.push('Passsword must be longer than 6 characters')
//         }

//         if (password.value.length >= 20) {
//             messages.push('Passsword must be less than 20 characters')
//         }

//         if (password.value === 'password' || password.value === 'Password') {
//             messages.push('Passsword cannot be Password')
//         }
//         if (messages.length > 0) {
//             e.preventDefault()
//             errorElement.innerText = messages.join(', ')
//         }
//     }

// )

function userExists() {
    alert("A user with the entered email already exists, try again");
}

function signupUnsuccessful() {
    alert("Problems with signin up, invalid email or password");

}


function ValidateEmail() {
    var email = document.getElementById("email_address").value;
    var lblError = document.getElementById("lblError");
    lblError.innerHTML = "";
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (!expr.test(email)) {
        lblError.innerHTML = "Invalid email address.";
    }
}

function ValidatePassword() {
    var password = document.getElementById('password')
    var lblError2 = document.getElementById("lblError2");
    if (password.value.length <= 6) {
        lblError2.innerHTML = 'Passsword must be longer than 6 characters';
    } else if (password.value.length >= 20) {
        lblError2.innerHTML = 'Passsword must be less than 20 characters';
    } else if (password.value === 'password' || password.value === 'Password') {
        lblError2.innerHTML = 'Passsword cannot be Password';
    } else {
        lblError2.innerHTML = '';
    }
}

function retypePassword() {
    var password = document.getElementById('password');
    var passwordRe = document.getElementById('passwordRe');
    var lblError3 = document.getElementById("lblError3");
    if (password.value != passwordRe.value) {
        lblError3.innerHTML = 'Passswords do not match';
    } else {
        lblError3.innerHTML = '';
    }
}