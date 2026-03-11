const form = document.getElementById("registrationForm");
const toggleBtn = document.getElementById("toggleAnalytics");
const analyticsPanel = document.getElementById("analyticsPanel");

let registrants = [];


form.addEventListener("submit", function(event){

    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const company = document.getElementById("company").value.trim();
    const attendance = document.querySelector('input[name="attendance"]:checked');

    clearErrors();

    if(!validateForm(name,email,attendance)) return;

    const user = {
        name,
        email,
        company,
        attendance: attendance.value
    };

    registrants.push(user);

    alert("Registration Successful");

    form.reset();

    updateStatistics();
});


function validateForm(name,email,attendance){

    let valid = true;

    if(name.length < 6 || name.length > 100){
        showError("nameError","Name must be 6-100 characters");
        valid = false;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if(!emailPattern.test(email)){
        showError("emailError","Enter a valid email address");
        valid = false;
    }

    if(!attendance){
        showError("attendanceError","Select attendance type");
        valid = false;
    }

    return valid;
}


function showError(id,message){
    document.getElementById(id).innerText = message;
}


function clearErrors(){
    document.getElementById("nameError").innerText="";
    document.getElementById("emailError").innerText="";
    document.getElementById("attendanceError").innerText="";
}


function updateStatistics(){

    let total = registrants.length;
    let virtual = 0;
    let inperson = 0;

    registrants.forEach(user=>{
        if(user.attendance === "Virtual"){
            virtual++;
        }else{
            inperson++;
        }
    });

    document.getElementById("total").innerText = total;
    document.getElementById("virtualCount").innerText = virtual;
    document.getElementById("inpersonCount").innerText = inperson;
}


toggleBtn.addEventListener("click", function(){

    analyticsPanel.classList.toggle("hidden");

    toggleBtn.innerText =
        analyticsPanel.classList.contains("hidden")
        ? "Show Event Analytics"
        : "Hide Event Analytics";
});