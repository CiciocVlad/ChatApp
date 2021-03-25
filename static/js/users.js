const searchBar = $('.users .search input')[0]
const searchBtn = $('.users .search button')[0]
const usersList = $('.users .users-list')[0]

searchBtn.onclick = () => {
	searchBar.classList.toggle('active')
	usersList.innerHTML = ''
	searchBar.focus()
	searchBtn.classList.toggle('active')
	searchBar.value = ''
}

searchBar.onkeyup = () => {
	let searchTerm = searchBar.value
	let xhr = new XMLHttpRequest()
	xhr.open('POST', 'api/search.php', true)
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data = xhr.response
				usersList.innerHTML = data
			}
		}
	}
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
	xhr.send(`searchTerm=${searchTerm}`)
}

setInterval(() => {
	let xhr = new XMLHttpRequest()
	xhr.open('GET', 'api/users.php', true)
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE)
			if (xhr.status === 200) {
				let data = xhr.response
				if (!searchBar.classList.contains('active'))
					usersList.innerHTML = data
			}
	}
	xhr.send()
}, 500)