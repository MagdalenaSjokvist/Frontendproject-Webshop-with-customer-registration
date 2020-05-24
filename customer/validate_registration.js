let submitRegistrationBtn = document.querySelector("#submit-registration-btn")

function enableRegSubmitIfFormIsValid() {
	if (
		isRegNameValid &&
		isRegNameValid &&
		isRegPasswordValid &&
		isRegPhoneValid &&
		isRegStreetValid &&
		isRegZipValid &&
		isRegCityValid
	) {
		submitRegistrationBtn.disabled = false
	}
}

let isRegNameValid = false
let isRegNameValid = false
let isRegPasswordValid = false
let isRegPhoneValid = false
let isRegStreetValid = false
let isRegZipValid = false
let isRegCityValid = false

// Validering av namn
function validateRegName() {
	let name = document.querySelector("#name").value
	let infoText = document.querySelector(".nameValidationText")

	if (name.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[0-9]").test(name)) {
		infoText.innerHTML = "OBS! Inga siffror tillåtna"
	} else if (name.length > 20) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 20 tecken"
	} else if (name.length < 2) {
		infoText.innerHTML = "OBS! Namnet måste innehålla mer än 2 tecken"
		// } else if (om namnet inte innehåller några mellanslag) {
		// 	infoText.innerHTML = "OBS! Namnet måste innehålla minst ett mellanslag"
	} else if (isValidRegName(name)) {
		infoText.innerHTML = "OBS! Ogiltigt namn"
	} else {
		infoText.innerHTML = ""
		isRegNameValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegNameValid = false
}
function isValidRegName(name) {
	let re = /[^a-öA-Ö\s:]/
	return re.test(String(name))
}

// Validering av mailadressen
function validateRegEmail() {
	let email = document.querySelector("#reg-email").value
	let infoText = document.querySelector(".emailValidationText")

	if (email.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (!isValidRegEmail(email)) {
		infoText.innerHTML = "OBS! Ogiltig e-postadress"
	} else if (email.length > 64) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 64 tecken"
	} else {
		infoText.innerHTML = ""
		isRegNameValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegNameValid = false
}
function isValidRegEmail(email) {
	let re = /^(([^<>()\[\]\\%.,;:\s@"]+(\.[^<>()\[\]\\%.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return re.test(String(email).toLowerCase())
}

//Validering av lösenord
function validateRegPassword() {
	let passwrd = document.querySelector("#reg-password").value
	let infoText = document.querySelector(".passwordValidationText")

	if (passwrd.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
		// } else if (om det inte är ett starkt lösenord) {
		// 	infoText.innerHTML = "OBS! Ditt lösenord är för svagt."
	} else {
		infoText.innerHTML = ""
		isRegPasswordValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegPasswordValid = false
}

function isValidRegPassword(passwrd) {
	let re = /^(([^<>()\[\]\\%.,;:\s@"]+(\.[^<>()\[\]\\%.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return re.test(String(passwrd))
}

// Validering av mobilnummer
function validateRegPhone() {
	let phone = document.querySelector("#reg-phone").value
	let infoText = document.querySelector(".phoneValidationText")

	if (phone.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[a-öA-Ö]").test(phone)) {
		infoText.innerHTML = "OBS! Inga bokstäver tillåtna"
	} else if (isValidRegPhone(phone)) {
		infoText.innerHTML = "OBS! Ogiltigt mobilnummer"
	} else if (phone.length != 10) {
		infoText.innerHTML = "OBS! Numret måste vara 10 siffror långt"
	} else {
		infoText.innerHTML = ""
		isRegPhoneValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegPhoneValid = false
}

function isValidRegPhone(phone) {
	let re = /[^0-9:]/
	return re.test(String(phone))
}

// Validering av gatuadress
function validateRegStreet() {
	let street = document.querySelector("#reg-street").value
	let infoText = document.querySelector(".streetValidationText")

	if (street.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (street.length > 40) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 40 tecken"
	} else if (street.length < 2) {
		infoText.innerHTML = "OBS! Måste skriva mer än 2 tecken"
	} else if (isValidRegStreet(street)) {
		infoText.innerHTML = "OBS! Ogiltigt adress"
	} else {
		infoText.innerHTML = ""
		isRegStreetValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegStreetValid = false
}
function isValidRegStreet(street) {
	let re = /[^a-öA-Ö\s0-9.,:]/
	return re.test(String(street))
}

// Validering av postnummer
function validateRegZipcode() {
	let zipElement = document.querySelector("#reg-zip")
	let zipcode = zipElement.value
	let infoText = document.querySelector(".zipcodeValidationText")

	determineMaxLength()

	if (zipcode.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (zipcode.length < 5) {
		infoText.innerHTML = "OBS! Ogiltigt postnummer"
	} else if (zipcode.charAt(0) == 0) {
		infoText.innerHTML = "OBS! Postnumret får inte börja på siffran 0"
	} else if (!isValidRegZipcode(zipcode) && zipcode.length > 6) {
		infoText.innerHTML = "OBS! Ogiltigt postnummer"
	} else {
		infoText.innerHTML = ""
		isRegZipValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegZipValid = false

	function determineMaxLength() {
		if (zipcode.includes(" ")) {
			zipElement.setAttribute("maxlength", "6")
		} else {
			zipElement.setAttribute("maxlength", "5")
		}
	}

	function isValidRegZipcode(zipcode) {
		let re = /^\d{3}\s(?:\d{2})?$/
		return re.test(String(zipcode))
	}
}

// Validering av ort
function validateRegCity() {
	let city = document.querySelector("#reg-city").value
	let infoText = document.querySelector(".cityValidationText")

	if (city.length === 0) {
		infoText.innerHTML = "OBS! Obligatoriskt fält"
	} else if (new RegExp("[0-9]").test(city)) {
		infoText.innerHTML = "OBS! Inga siffror tillåtna"
	} else if (city.length > 20) {
		infoText.innerHTML = "OBS! Otillåtet med fler än 20 tecken"
	} else if (city.length < 2) {
		infoText.innerHTML = "OBS! Måste skriva mer än 2 tecken"
	} else if (isValidRegCity(city)) {
		infoText.innerHTML = "OBS! Ogiltig ort"
	} else {
		infoText.innerHTML = ""
		isRegCityValid = true
		enableRegSubmitIfFormIsValid()
		return
	}
	submitRegistrationBtn.disabled = true
	isRegCityValid = false
}
function isValidRegCity(city) {
	let re = /[^a-öA-Ö\s:]/
	return re.test(String(city))
}
