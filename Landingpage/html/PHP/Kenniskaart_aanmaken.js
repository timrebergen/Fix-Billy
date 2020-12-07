function validateForm() {
    let elemlength = document.getElementById('invulveld').value.length;
    if (elemlength > 3) {
        alert("De beschrijving mag niet langer dan 150 karakters zijn");
        return false;
    } else {
        post_description()
        return true;
    }
}