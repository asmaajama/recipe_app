function validateRecipe() {
    let title = document.getElementById("title").value;
    let ingredients = document.getElementById("ingredients").value;

    if (title.trim() === "" || ingredients.trim() === "") {
        alert("Please fill in all required fields.");
        return false;
    }

    return true;
}
