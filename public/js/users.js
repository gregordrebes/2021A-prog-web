function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}; 

docReady(function(){
    document.getElementById("change_password").addEventListener("change", function(e){
        let isChecked = this.checked;
        
        let passwordField = document.getElementById("password-form-group");
        let confirmPasswordField = document.getElementById("confirm-password-form-group");

        if (isChecked){
            passwordField.classList.remove("d-none");
            confirmPasswordField.classList.remove("d-none");
        } else {
            passwordField.classList.add("d-none");
            confirmPasswordField.classList.add("d-none"); 
        }
    });
});
