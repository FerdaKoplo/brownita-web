function setupPasswordToggle(inputId, toggleButtonId) {
    const toggleButton = document.getElementById(toggleButtonId)
    const input = document.getElementById(inputId)

    toggleButton.addEventListener('click', (e) => {
        const icon = toggleButton.querySelector('i')

        const currentType = input.getAttribute('type')
        const newType = currentType === 'password' ? 'text' : 'password'
        input.setAttribute('type', newType)

        icon.classList.toggle('fa-eye')
        icon.classList.toggle('fa-eye-slash')

        e.preventDefault()
    })
}

setupPasswordToggle('password', 'toggle-password')
setupPasswordToggle('password_confirmation', 'toggle-password-confirmation')
