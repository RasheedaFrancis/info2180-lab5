window.onload = function () {
    document.getElementById("lookup").addEventListener("click", function (event) {
        event.preventDefault();

        let country = document.getElementById("country").value.trim().replace(/(<([^>]+)>)/gi, "");

        fetch(`http://localhost/info2180-lab5/world.php?country=${country}`)
            .then(response => {
                return response.text();
            })
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error.message);
            });
    });
};
