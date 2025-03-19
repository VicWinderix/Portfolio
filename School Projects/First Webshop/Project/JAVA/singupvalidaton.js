function validateAndSubmit() {
    var firstName = document.getElementById("firstName").value.trim();
    var lastName = document.getElementById("lastName").value.trim();
    var email = document.getElementById("email").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var password = document.getElementById("password").value.trim();
    var confirmPassword = document.getElementById("confirm-password").value.trim();
    var street = document.getElementById("street").value.trim();
    var houseNumber = document.getElementById("house-number").value.trim();
    var postalCode = document.getElementById("postal-code").value.trim();
    var city = document.getElementById("city").value.trim();
    var country = document.getElementById("country").value.trim();

    const phoneRegex = /^\d{10,15}$/;

    // Controleer of een van de velden leeg is
    if (firstName === "" || lastName === "" || email === "" || password === "" || confirmPassword === "" || street === "" || houseNumber === "" || postalCode === "" || city === "" || country === "") {
        document.getElementById("sub").innerHTML = "Fill in every input";
        return false;
    }
    if (!email.includes("@")) {
        document.getElementById("sub").innerHTML = "Invalid mail address";
        return false;
    }
    
    if (!phoneRegex.test(phone)) {
        document.getElementById("sub").innerHTML = "Invalid phone number";
        return false;
    }
    if (password !== confirmPassword) {
        document.getElementById("sub").innerHTML = "Passwords do not match";
        return false;
    }
    document.getElementById("sub").innerHTML = "Form submitted successfully!";
    return true;
}
