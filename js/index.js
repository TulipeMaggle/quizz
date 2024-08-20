if (!document.cookie.includes('theme')) {
	document.cookie = 'theme=blanc'
}
const boutonConnexion = document.querySelector('#SignIN')
const boutonCreer = document.querySelector('#SinUP')

const box = document.querySelector('.box')

if (window.location.search == '?methode=connexion') {
	Formulaire(1)
} else if (window.location.search == '?methode=inscription') {
	Formulaire(2)
}

function Formulaire(lequel) {
	if (lequel == 1) {
		document.querySelector('#displayons').classList.remove('dispositif')
		document.querySelector('#displayis').classList.add('dispositif')
	} else if (lequel == 2) {
		document.querySelector('#displayons').classList.add('dispositif')
		document.querySelector('#displayis').classList.remove('dispositif')
	}
	// checkUP(lequel)
}

function checkUP(bouton) {
	const champs = document.querySelectorAll('.champs')
	if (bouton == 2) {
		bouton = document.querySelector('button[form="formInsc"]')
		email = document.querySelector('#Iemail')
		// mdp = document.querySelector('#Imdp')
		// pseudo = document.querySelector('#pseudo')
	} else {
		bouton = document.querySelector('button[form="formConn"]')
		email = document.querySelector('#Cemail')
		// mdp = document.querySelector('#Cmdp')
	}

	bouton.addEventListener('click', (e) => {
		champs.forEach((element, index) => {
			if (element.value == '') {
				e.preventDefault()

				const listP = document.querySelectorAll('.attention')

				listP[index].innerText = 'Champs invalide'

				element.classList.add('galere')
			} else if (element.value !== '') {
				element.classList.remove('galere')
				listP[index].innerText = ''
			}
		})
		if (!email.value.includes('@')) {
			e.preventDefault()
			email.classList.add('galere')
		} else {
			email.classList.remove('galere')
		}
	})
}
