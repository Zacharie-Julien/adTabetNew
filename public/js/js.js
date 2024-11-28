function genererNomUtilisateur(event) {
    event.preventDefault();

    const nom = document.getElementById("nom").value.trim().toLowerCase();
    const prenom = document.getElementById("prenom").value.trim().toLowerCase();
    const email = document.getElementById("email").value.trim();

    if (!nom || !prenom || !email) {
        alert("Veuillez remplir tous les champs !");
        return;
    }

    let nomUtilisateur = prenom + "." + nom;

    if (nomUtilisateur.length > 20) {
        const espaceDisponible = 20 - (nom.length + 1);
        if (espaceDisponible > 0) {
            nomUtilisateur = prenom.substring(0, espaceDisponible) + "." + nom;
        } else {
            nomUtilisateur = nom;
        }
    }

    console.log("Nom :", nom);
    console.log("Prénom :", prenom);
    console.log("E-mail :", email);
    console.log("Nom d'utilisateur :", nomUtilisateur);

    alert(`Nom d'utilisateur généré : ${nomUtilisateur}`);
}

document.addEventListener("DOMContentLoaded", () => {
    const formulaire = document.getElementById("formulaire");
    formulaire.addEventListener("submit", genererNomUtilisateur);
});