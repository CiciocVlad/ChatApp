const form = document.querySelector('.signup form')
const continueBtn = form.querySelector('.button input')
const errorText = form.querySelector('.error-txt')

form.onsubmit = e => {
	e.preventDefault()
}

continueBtn.onclick = () => {
	let xhr = new XMLHttpRequest()
	xhr.open('POST', 'api/signup.php', true)
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data = xhr.response
				if (data == 'success') {
					location.href = '../../users.php'
				}
				else {
					errorText.textContent = data
					errorText.style.display = 'block'
				}
			}
		}
	}
	// send form data through ajax to php
	let formData = new FormData(form) // creating new form data object
	xhr.send(formData) // sending the form data to php
}