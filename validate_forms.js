let submitBtn = document.querySelector(".form-container__submit-button")

function enableSubmitIfFormIsValid() {
	if (
		isNameValid &&
		isEmailValid &&
		isPasswordValid &&
		isPhoneValid &&
		isStreetValid &&
		isZipcodeValid &&
		isCityValid
	) {
		submitBtn.disabled = false
	}
}

let isNameValid = false
let isEmailValid = false
let isPasswordValid = false
let isPhoneValid = false
let isStreetValid = false
let isZipcodeValid = false
let isCityValid = false

// Validering av namn
function validateName() {
	let name = document.querySelector("#name").value
	let infoText = document.querySelector(".nameValidationText")
	// let spaceRegex = /\s/

	if (name.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[0-9]").test(name)) {
		infoText.innerHTML = "OBS! Inga siffror tillåtna"
	} else if (!name.match(/\s/)) {
		infoText.innerHTML = "OBS! Namnet måste innehålla minst ett mellanslag"
	} else if (name.length > 20) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 20 tecken"
	} else if (name.length < 2) {
		infoText.innerHTML = "OBS! Namnet måste innehålla mer än 2 tecken"
		// } else if (om namnet inte innehåller några mellanslag) {
		// 	infoText.innerHTML = "OBS! Namnet måste innehålla minst ett mellanslag"
	} else if (isValidName(name)) {
		infoText.innerHTML = "OBS! Ogiltigt namn"
	} else {
		infoText.innerHTML = ""
		isNameValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isNameValid = false
}
function isValidName(name) {
	let re = /[^a-öA-Ö\s:]/
	return re.test(String(name))
}

// Validering av mailadressen
function validateEmail() {
	let email = document.querySelector("#email").value
	let infoText = document.querySelector(".emailValidationText")

	if (email.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (!isValidEmail(email)) {
		infoText.innerHTML = "OBS! Ogiltig e-postadress"
	} else if (email.length > 64) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 64 tecken"
	} else {
		infoText.innerHTML = ""
		isEmailValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isEmailValid = false
}
function isValidEmail(email) {
	let re = /^(([^<>()\[\]\\%.,;:\s@"]+(\.[^<>()\[\]\\%.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return re.test(String(email).toLowerCase())
}

//Validering av lösenord
function validatePassword() {
	let password = document.querySelector("#password").value
	let infoText = document.querySelector(".passwordValidationText")

	if (password.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"

		// } else if (villkor: om det inte är ett starkt lösenord) {
		// 	infoText.innerHTML = "OBS! Ditt lösenord är för svagt."
	} else {
		infoText.innerHTML = ""
		isPasswordValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isPasswordValid = false
}

function isValidPassword(password) {
	let re = /^(([^<>()\[\]\\%.,;:\s@"]+(\.[^<>()\[\]\\%.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return re.test(String(password))
}

// Validering av mobilnummer
function validatePhone() {
	let phone = document.querySelector("#phone").value
	let infoText = document.querySelector(".phoneValidationText")

	if (phone.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[a-öA-Ö]").test(phone)) {
		infoText.innerHTML = "OBS! Inga bokstäver tillåtna"
	} else if (isValidPhone(phone)) {
		infoText.innerHTML = "OBS! Ogiltigt telefonnummer"
	} else {
		infoText.innerHTML = ""
		isPhoneValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isPhoneValid = false
}

function isValidPhone(phone) {
	let re = /[^0-9:\s-]/
	return re.test(String(phone))
}

// Validering av gatuadress
function validateStreet() {
	let street = document.querySelector("#street").value
	let infoText = document.querySelector(".streetValidationText")

	if (street.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (street.length > 40) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 40 tecken"
	} else if (street.length < 2) {
		infoText.innerHTML = "OBS! Måste skriva mer än 2 tecken"
	} else if (isValidStreet(street)) {
		infoText.innerHTML = "OBS! Ogiltigt adress"
	} else {
		infoText.innerHTML = ""
		isStreetValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isStreetValid = false
}
function isValidStreet(street) {
	let re = /[^a-öA-Ö\s0-9.,:]/
	return re.test(String(street))
}

// Validering av postnummer
function validateZipcode() {
	let zipElement = document.querySelector("#zip")
	let zipcode = zipElement.value
	let infoText = document.querySelector(".zipcodeValidationText")

	determineMaxLength()

	if (zipcode.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (zipcode.length < 5) {
		infoText.innerHTML = "OBS! Ogiltigt postnummer"
	} else if (zipcode.charAt(0) == 0) {
		infoText.innerHTML = "OBS! Postnumret får inte börja på siffran 0"
	} else if (!isValidZipcode(zipcode) && zipcode.length > 6) {
		infoText.innerHTML = "OBS! Ogiltigt postnummer"
	} else {
		infoText.innerHTML = ""
		isZipcodeValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isZipcodeValid = false

	function determineMaxLength() {
		if (zipcode.includes(" ")) {
			zipElement.setAttribute("maxlength", "6")
		} else {
			zipElement.setAttribute("maxlength", "5")
		}
	}

	function isValidZipcode(zipcode) {
		let re = /^\d{3}\s(?:\d{2})?$/
		return re.test(String(zipcode))
	}
}

// Validering av ort
function validateCity() {
	let city = document.querySelector("#city").value
	let infoText = document.querySelector(".cityValidationText")

	if (city.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[0-9]").test(city)) {
		infoText.innerHTML = "OBS! Inga siffror tillåtna"
	} else if (city.length > 20) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 20 tecken"
	} else if (city.length < 2) {
		infoText.innerHTML = "OBS! Måste skriva mer än 2 tecken"
	} else if (isValidCity(city)) {
		infoText.innerHTML = "OBS! Ogiltig ort"
	} else {
		infoText.innerHTML = ""
		isCityValid = true
		enableSubmitIfFormIsValid()
		return
	}
	submitBtn.disabled = true
	isCityValid = false
}
function isValidCity(city) {
	let re = /[^a-öA-Ö\s:]/
	return re.test(String(city))
}
