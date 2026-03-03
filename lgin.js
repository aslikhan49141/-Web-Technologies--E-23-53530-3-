let wrongAttempts = 0;

function validateForm() {

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let errorMsg = document.getElementById("errorMsg");
    let attemptCount = document.getElementById("attemptCount");

    errorMsg.innerHTML = "";


    if (!email.includes("@")) {
        wrongAttempts++;
        errorMsg.innerHTML = "Email must contain '@'";
        attemptCount.innerHTML = "Wrong Attempts: " + wrongAttempts;
        return false;
    }

    
    if (password.length < 6) {
        wrongAttempts++;
        errorMsg.innerHTML = "Password must be at least 6 characters long";
        attemptCount.innerHTML = "Wrong Attempts: " + wrongAttempts;
        return false;
    }

    
    if (!password.includes("#")) {
        wrongAttempts++;
        errorMsg.innerHTML = "Password must contain '#'";
        attemptCount.innerHTML = "Wrong Attempts: " + wrongAttempts;
        return false;
    }

    
    errorMsg.style.color = "green";
    errorMsg.innerHTML = "Login Successful!";
    return false;  
}