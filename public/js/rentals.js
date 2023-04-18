// Defines constraints to be used for the vehicle data entry
let constraints = {
    vehicle_make: {
        min: 1,
        max: 50,
        required: true
    },
    vehicle_model: {
        min: 1,
        max: 100,
        required: true
    },
    vehicle_bodytype: {
        min: 1,
        max: 500,
        required: true
    },
    fuel_type: {
        min: 1,
        max: 100,
        required: true
    },
    mileage: {
        min: 1,
        max: 100,
        required: true
    },
    location: {
        min: 1,
        max: 100,
        required: true
    },
    year: {
        min: 1,
        max: 5,
        required: true
    },
    num_doors: {
        min: 1,
        max: 5,
        required: true
    },
    image_url: {
        min: 1,
        max: 100,
        required: false
    }
}

// This web page works using a dynamic set up, every time a change is made a request is made to the server to get the updated table information, however only the table information is gathered and is placed into the table without a page reload
function refreshTable () {
    fetch("/rentals/all_vehicles", {
        method: 'GET',
        headers: {
        },
        credentials: 'same-origin'
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("table-data").innerHTML = data

        refreshQuerySelectors()
    })
}

//Re-runs the query selectors since the page content is now different and the query selectors would have been deleted, in essence re-loads the javascript
function refreshQuerySelectors () {
    document.querySelectorAll('.rentals-input').forEach(element => {
        element.addEventListener('change', (e) => {
            //Fetch is similar to AJAX but a more modern varitation, here it is sending data to the edit_vehicle endpoint
            fetch("/rentals/edit_vehicle", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    name: e.target.name,
                    value: e.target.value,
                    vehicle_id: e.target.parentElement.parentElement.id
                })
            })
            .then(res => {
                
            })
        })
    })
    
    //Used to delete a vehicle, takes the vehicle id
    document.querySelectorAll('.car-delete').forEach(element => {
        element.addEventListener('click', (e) => {
            fetch("/rentals/delete_vehicle", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    vehicle_id: e.target.parentElement.parentElement.id
                })
            })
            .then(res => {
                refreshTable()
            })
        })
    })
    
    //Here two different query selectors are used since it is possible to trigger the add feature by either pressing enter or clicking the add button
    document.querySelectorAll('.car-add').forEach(element => {
        element.addEventListener('click', carAdd)
    })
    
    document.querySelectorAll('.rentals-add').forEach(element => {
        element.addEventListener('keydown', (e) => {
            if (e.key == "Enter") {
                carAdd(e)
            }
        })
    })

    // This function will add cars to the database
    function carAdd (e) {
        //Creates an array of all the inputs there are in this table row
        let nodes = e.target.parentElement.parentElement.childNodes
        var data = {}
        var valid_data = true

        // Loops through each node
        nodes.forEach(element => {
            let input = element.childNodes[0]
            
            //Will only run the code on elements with the tag "TG" that are not read only and are also not the add button itself]
            if (element.tagName == "TD" && !!input && input.tagName == "INPUT" && !input.getAttribute("readonly") && input.textContent != "Add") {
                console.log(input)
                //Runs the validate field function to verify the data
                let checkedValue = validateField(input.value, constraints[input.name])

                //selects the tool tip
                let tooltip = input.parentElement.childNodes[1]

                if (checkedValue) {
                    // This will run if checked Value returns true, which means that there was an error in the data, this will then be sent to the tool tips and displayed to the user
                    valid_data = false
                    input.classList.add("error-border")
                    tooltip.textContent = checkedValue
                    tooltip.classList.add("visible")
                } else {
                    // if data checks are not required do not add a border or make the tooltip visible
                    if (constraints[input.name].required) {
                        input.classList.remove("error-border")
                        tooltip.classList.remove("visible")
                    }
                    data[input.name] = input.value
                }
            }
        })

        //If all data is proved to be valid add data to the database
        if (valid_data) {
            fetch("/rentals/add_vehicle", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(data)
            })
            .then(res => {
                refreshTable()
            })
        }
    }

    function validateField (value, local_constraints) {
        // function will take an input value and a local_constraints object which contains a min, max, confirmation comparison value and optional regex and will return a response based on if it meets the criteria, if there is no data response then that means it is valid.
        if (local_constraints.required) {
            if (value.length < local_constraints.min) {
                // Data is too short
                return "Must be at least " + local_constraints.min + " character(s) long."
            } else if (value.length > local_constraints.max) {
                //Data is too long
                return "Must be less than " + local_constraints.max + " character(s) long."
            } else {
                //Data is valid
                return ""
            }
        } else {
            //Data is not required and is not checked
            return ""
        }
    }
    
    //Load preview image whenever an image is placed into the uploader
    document.getElementById("img-upload").addEventListener('change', (e) => {
        
        document.getElementById("img-preview").src = createObjectURL(e.target.files[0])
    
        document.getElementById("img-upload-btn").classList.remove("d-none")
    })
    
    // Take the image uploaded to the clientside and send to the server side
    document.getElementById("img-upload-btn").addEventListener('click', (e) => {
        var data = new FormData()
        data.append('file', document.getElementById("img-upload").files[0])
    
        fetch("/rentals/upload_image", {
            method: 'POST',
            credentials: 'same-origin',
            body: data
        })
        .then(res => res.text())
        .then(data => {
            // close the modal and update the table information with the new url information
            document.getElementById("myModal").classList.remove('d-block')
            document.getElementById("rentals-add-img").outerHTML = '<input type="text" name="image_url" class="table-input rentals-add" value="/public/img/uploads/' + data + '.png">'
            document.getElementById("img-preview").src = ""
            document.getElementById("img-upload-btn").classList.add("d-none")
        })
    })
    
    document.getElementById("rentals-add-img").addEventListener('click', (e) => {
        document.getElementById("myModal").classList.add('d-block')
    })
    
    document.getElementById("img-upload-cancel").addEventListener('click', (e) => {
        document.getElementById("myModal").classList.remove('d-block')
    })
    
    function createObjectURL(object) {
        return (window.URL) ? window.URL.createObjectURL(object) : window.webkitURL.createObjectURL(object);
    }
    
    function revokeObjectURL(url) {
        return (window.URL) ? window.URL.revokeObjectURL(url) : window.webkitURL.revokeObjectURL(url);
    }
}

refreshTable()