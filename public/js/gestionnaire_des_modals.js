// Fonction pour gérer l'affichage des modals
function handleTaxiModal() {
    const taxiInfo = document.getElementById('taxiInfo');
    const hasTaxiInfo = taxiInfo && !taxiInfo.textContent.includes('Aucune information de taxi disponible.');

    if (hasTaxiInfo) {
        openUpdateTaxiModal(); // Afficher la modal de modification
    } else {
        openTaxiModal(); // Afficher la modal d'ajout
    }
}

// Fonctions pour ouvrir et fermer les modals
function openTaxiModal() {
    document.getElementById('taxiModal').classList.remove('hidden');
}

function closeTaxiModal() {
    document.getElementById('taxiModal').classList.add('hidden');
}

function openUpdateTaxiModal() {
    document.getElementById('updateTaxiModal').classList.remove('hidden');
}

function closeUpdateTaxiModal() {
    document.getElementById('updateTaxiModal').classList.add('hidden');
}