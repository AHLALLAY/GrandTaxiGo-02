document.getElementById('depart').addEventListener('change', function() {
    var depart = this.value;
    var destinationOptions = document.getElementById('destination').options;
    for (var i = 0; i < destinationOptions.length; i++) {
        destinationOptions[i].disabled = (destinationOptions[i].value === depart);
    }
});

document.getElementById('destination').addEventListener('change', function() {
    var destination = this.value;
    var departOptions = document.getElementById('depart').options;
    for (var i = 0; i < departOptions.length; i++) {
        departOptions[i].disabled = (departOptions[i].value === destination);
    }
});