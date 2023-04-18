// Object defines the constraints of each of the input values
let constraints = {
    username: {
        min: 2,
        max: 20,
        regex: "",
        required: true
    },
    password: {
        min: 2,
        max: 10,
        regex: "",
        required: true,
        confirm: "password-confirm"
    },
    "password-confirm": {
        min: 2,
        max: 10,
        regex: "",
        required: true,
        confirm: "password"
    },
    title: {
        min: 1,
        max: 10,
        regex: "",
        required: true
    },
    fname: {
        min: 2,
        max: 50,
        regex: "",
        required: true
    },
    sname: {
        min: 2,
        max: 50,
        regex: "",
        required: true
    },
    address1: {
        min: 1,
        max: 50,
        regex: "",
        required: true
    },
    address2: {
        min: 0,
        max: 50,
        regex: "",
        required: false
    },
    address3: {
        min: 0,
        max: 50,
        regex: "",
        required: false
    },
    postcode: {
        min: 6,
        max: 8,
        regex: /([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2})/,
        required: true
    },
    email: {
        min: 2,
        max: 100,
        regex: /^[\w-\.]+@([\w-]+\.)+[\w-]{2,10}$/,
        required: true
    },
    telephone: {
        min: 2,
        max: 15,
        regex: /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/,
        required: true
    }
}

// Query selector saves all of the inputs into an array, this array will then be looped through on each value and sets their html tags to match the data held in the constraints object, ensures that the data enforced through html accurately matches the actual data constraints.
let inputs = document.querySelectorAll("input")
inputs.forEach(element => {
    element.setAttribute("minlength", constraints[element.id].min)
    element.setAttribute("maxlength", constraints[element.id].max)
    if (constraints[element.id].required) {
        element.setAttribute("required", "required")
    }
})

function validateField (value, local_constraints, id) {
    // function will take an input value and a local_constraints object which contains a min, max, confirmation comparison value and optional regex and will return a response based on if it meets the criteria, if there is no data response then that means it is valid.
    if (local_constraints.confirm && !(document.getElementById(id).value == document.getElementById(local_constraints.confirm).value)) {
        // This means that the two compared values do not match where they should
        return "Passwords must match"
    } else if (local_constraints.regex && !local_constraints.regex.test(value)) {
        // This means that there is regex values but the data does not meet the requirements
        return "Data is invalid"
    } else if (value.length < local_constraints.min) {
        // Data is too short
        return "Must be at least " + local_constraints.min + " character(s) long."
    } else if (value.length > local_constraints.max) {
        //Data is too long
        return "Must be less than " + local_constraints.max + " character(s) long."
    } else {
        //Data is valid
        return ""
    }
}

// Creates an event listener for when the user attempts to submit the data
document.getElementById("register-submit").addEventListener('click', (e) => {
    let inputs = document.querySelectorAll("input")

    inputs.forEach(element => {
        let nextTag = element.nextElementSibling
        let checkedValue = validateField(element.value, constraints[element.id], element.id)

        if (checkedValue) {
            nextTag.textContent = checkedValue
            nextTag.classList.remove('d-none')
            element.classList.add('invalid')
            e.preventDefault()
        } else {
            nextTag.classList.add('d-none')
            element.classList.remove('invalid')
        }
    })
})