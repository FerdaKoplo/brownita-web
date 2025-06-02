const togglePassword = document.getElementById('toggle-password')
const password = document.getElementById('password')

togglePassword.addEventListener('click', (e) => {

    const currentType = password.getAttribute('type')
    const newType = currentType === 'password' ? 'text' : 'password'
    password.setAttribute('type', newType)

    togglePassword.classList.toggle('fa-eye')
    togglePassword.classList.toggle('fa-eye-slash')

    e.preventDefault()
})
