window.onload = function () {
    document.getElementById("lookup").addEventListener("click", function (event) {
        event.preventDefault();

        let country = document.getElementById("country").value.trim().replace(/(<([^>]+)>)/gi, "");
        
        
        

        fetch(`http://localhost/info2180-lab5/world.php?country=${country}`)
            .then(response => {
               
                return response.text();
            })
            .then(data => {
                if (country === "") {
                    document.getElementById("result").innerHTML = 'Please enter a valid country name.</p>';
                }else{
                document.getElementById("result").innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error.message);
            });
    });
    document.getElementById("lookup_cities").addEventListener("click", function (event) {
        event.preventDefault();

        let country = document.getElementById("country").value.trim().replace(/(<([^>]+)>)/gi, "");

        fetch(`http://localhost/info2180-lab5/world.php?country=${country}&lookup=cities`)
            .then(response => {
                
               
                return response.text();
                
               
            })
            .then(data => {
               
                if (country === "") {
                    document.getElementById("result").innerHTML = 'Please enter a valid country name.</p>';
                }else{
                document.getElementById("result").innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error.message);
            });
    });
};
