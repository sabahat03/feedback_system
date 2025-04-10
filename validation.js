function validateForm() {
    // Get form elements
    const name = document.getElementById("name");
    const facultyName = document.getElementById("faculty_name");
    const subjectName = document.getElementById("subject_name");
    const topicsCovered = document.getElementById("topics_covered");
    const contentDeliveryMethod = document.getElementById("content_delivery_method");
    
    // Remove all existing error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(message => message.remove());
    
    // Remove error class from all elements
    const formElements = document.querySelectorAll("input, select, textarea");
    formElements.forEach(element => element.classList.remove("error"));
    
    // Validation flag
    let isValid = true;
    
    // Validate Student Name
    if (name.value.trim() === "") {
        displayError(name, "Please enter your name");
        isValid = false;
    }
    
    // Validate Faculty Selection
    if (facultyName.value === "") {
        displayError(facultyName, "Please select a faculty");
        isValid = false;
    }
    
    // Validate Subject Selection
    if (subjectName.value === "") {
        displayError(subjectName, "Please select a subject");
        isValid = false;
    }
    
    // Validate Topics Covered
    if (topicsCovered.value.trim() === "") {
        displayError(topicsCovered, "Please enter topics covered");
        isValid = false;
    }
    
    // Validate Content Delivery Method
    if (contentDeliveryMethod.value === "") {
        displayError(contentDeliveryMethod, "Please select a content delivery method");
        isValid = false;
    }
    
    // Return validation result
    return isValid;
}

function displayError(element, message) {
    // Add error class to the element
    element.classList.add("error");
    
    // Create error message
    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.innerText = message;
    
    // Insert error message after the element
    element.parentNode.insertBefore(errorDiv, element.nextSibling);
}

