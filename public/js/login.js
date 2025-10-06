document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {
            const response = await axios.post('http://127.0.0.1:8000/api/login', {
                email,
                password
            });

            const { token, user } = response.data;

            // Guardar token y sesión
            localStorage.setItem('token', token);
            localStorage.setItem('auth', 'true');

            Swal.fire({
                icon: 'success',
                title: `Bienvenido ${user.name}`,
                text: 'Inicio de sesión exitoso',
                timer: 2000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 2000);

        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Error al iniciar sesión',
                text: error.response?.data?.message || 'Credenciales incorrectas o error del servidor'
            });
        }
    });
});
