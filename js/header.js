const theme = document.querySelector('#checkbox')
const cookieString = document.cookie.split(';')
const r = document.querySelector(':root')

theme.addEventListener('click', changerTheme)

function changerTheme() {
	if (document.cookie.includes('theme=noir')) {
		document.cookie = 'theme=blanc'
		mettreFondBlanc()
	} else {
		document.cookie = 'theme=noir'
		mettreFondNoir()
		console.log(theme)
	}
}

function cherckerTheme() {
	if (document.cookie.includes('theme=noir')) {
		theme.checked = true
		mettreFondNoir()
	} else {
		theme.checked = false
		mettreFondBlanc()
	}
}

function mettreFondNoir() {
	r.style.setProperty('--fond', '#282828')
	r.style.setProperty('--fond-reverse', '#f5f5f5')
}

function mettreFondBlanc() {
	r.style.setProperty('--fond', '#f5f5f5')
	r.style.setProperty('--fond-reverse', '#282828')
}

function deconnexion() {
	document.cookie = 'id=;Max-Age=-99999999'
}

cherckerTheme()
