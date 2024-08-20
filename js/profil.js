const pseudo_input = document.querySelector('#pseudo-input')
const email_input = document.querySelector('#email-input')

const pseudo_edit = document.querySelector('#pseudo-edit')
const email_edit = document.querySelector('#email-edit')

const edit_buttons = [pseudo_edit, email_edit]
const inputs = [pseudo_input, email_input]

const enregistrer = document.querySelector('#enregistrer')

for (let index = 0; index < edit_buttons.length; index++) {
	const element = edit_buttons[index]

	element.addEventListener('click', () => {
		inputs[index].removeAttribute('disabled')
	})
}

inputs.forEach((element) => {
	element.addEventListener('keyup', check)
})

function check() {
	if (inputs[0].value !== '' && inputs[1].value !== '') {
		enregistrer.removeAttribute('disabled')
	} else {
		enregistrer.setAttribute('disabled', 'disabled')
	}
}

enregistrer.addEventListener('click', () => {
	inputs.forEach((element) => {
		element.removeAttribute('disabled')
		setTimeout(function () {
			location.reload()
		}, 3000)
	})
})
