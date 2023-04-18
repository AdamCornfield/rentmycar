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

function refreshQuerySelectors () {
    document.querySelectorAll('.rentals-input').forEach(element => {
        element.addEventListener('change', (e) => {
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

    function carAdd (e) {
        let nodes = e.target.parentElement.parentElement.childNodes
        var data = {}
        var valid_data = true

        nodes.forEach(element => {
            let input = element.childNodes[0]
            
            if (element.tagName == "TD" && !input.getAttribute("readonly") && input.textContent != "Add") {
                let checkedValue = validateField(input.value, constraints[input.name])
                let tooltip = input.parentElement.childNodes[1]

                if (checkedValue) {
                    valid_data = false
                    input.classList.add("error-border")
                    tooltip.textContent = checkedValue
                    tooltip.classList.add("visible")
                } else {
                    if (constraints[input.name].required) {
                        input.classList.remove("error-border")
                        tooltip.classList.remove("visible")
                    }
                    data[input.name] = input.value
                }
            }
        })

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
    
    document.getElementById("img-upload").addEventListener('change', (e) => {
        //console.log(e.target.files[0])
        
        document.getElementById("img-preview").src = createObjectURL(e.target.files[0])
    
        document.getElementById("img-upload-btn").classList.remove("d-none")
    })
    
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
            document.getElementById("myModal").classList.remove('d-block')
            document.getElementById("rentals-add-img").outerHTML = '<input type="text" name="image_url" class="table-input rentals-add" value="/public/img/uploads/' + data + '.png">'
            document.getElementById("img-preview").src = ""
            document.getElementById("img-upload-btn").classList.add("d-none")
        })
    })
    
    document.getElementById("rentals-add-img").addEventListener('click', (e) => {
        document.getElementById("myModal").classList.add('d-block')
    })
    
    function createObjectURL(object) {
        return (window.URL) ? window.URL.createObjectURL(object) : window.webkitURL.createObjectURL(object);
    }
    
    function revokeObjectURL(url) {
        return (window.URL) ? window.URL.revokeObjectURL(url) : window.webkitURL.revokeObjectURL(url);
    }
}

refreshTable()